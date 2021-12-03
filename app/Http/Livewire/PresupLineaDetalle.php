<?php

namespace App\Http\Livewire;

use App\Models\{Producto,Accion,AccionTipo, EmpresaTipo, Presupuesto,PresupuestoLinea,PresupuestoLineaDetalle, ProductoFamilia};
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class PresupLineaDetalle extends Component
{
    public $acciontipoId;
    public $filtrofamilia='';
    public $filtrodescripcion='';
    public $presuplinea;
    public $presupuestolinea;
    public $presupuestolineadetalleId='';
    public $accionproducto;
    public $showAnchoAlto=false;


    public AccionTipo $acciontipo;

    public $empresaTipo;

    public $visible=true;
    public $orden=1;
    public $descripcion;
    public $preciotarifa=0;
    public $preciotarifa_ud=0;
    public $udpreciotarifa_id;
    public $precioventa=0;
    public $ancho=1;
    public $alto=1;
    public $metros2=0;
    public $factor;
    public $factormin;
    public $unidades=1;
    public $accionproducto_id;
    public $observaciones;
    public $unidadventa='';

    protected $rules = [
        'visible'=>'',
        'orden'=>'nullable|numeric',
        'preciotarifa'=>'nullable|numeric',
        'preciotarifa_ud'=>'nullable|numeric',
        'precioventa'=>'nullable|numeric',
        'udpreciotarifa_id'=>'nullable|numeric',
        'ancho'=>'nullable|numeric',
        'alto'=>'nullable|numeric',
        'metros2'=>'nullable|numeric',
        'factor'=>'nullable|numeric',
        'unidades'=>'nullable|numeric',
        'accionproducto_id'=>'required',
    ];

    protected $listeners = [ 'presuplineadetallerefresh' => '$refresh'];

    public function mount(PresupuestoLinea $presupuestolinea)
    {
        $this->presuplinea=$presupuestolinea;
        $this->empresaTipo=EmpresaTipo::find($presupuestolinea->presupuesto->entidad->empresatipo_id);
        $this->factor=$this->empresaTipo->factor ?? '1';
        $this->factormin=$this->empresaTipo->factormin ?? '1';
    }

    public function render()
    {
        $this->acciontipo=AccionTipo::find($this->acciontipoId);
        $familias=ProductoFamilia::orderBy('nombre')->get();

        $presupacciones=PresupuestoLineaDetalle::where('presupuestolinea_id',$this->presuplinea->id)
        ->where('acciontipo_id',$this->acciontipoId)
        ->orderBy('orden')
        ->get();

        $this->tituloaccion=$this->acciontipo->nombre;

        if($this->acciontipoId!='1')
            $acciones=Accion::where('acciontipo_id',$this->acciontipoId)->orderBy('descripcion')->get();
        else{
            $acciones=Producto::query()
            ->search('referencia',$this->filtrodescripcion)
            ->orSearch('descripcion',$this->filtrodescripcion)
            ->when($this->filtrofamilia!='', function ($query){
                $query->where('familia_id',$this->filtrofamilia);
                })
            ->orderBy('referencia','asc')
            ->get();
        }

        return view('livewire.presup-linea-detalle',compact('acciones','presupacciones','familias'));
    }

    public function UpdatedAccionproductoId()
    {
        if($this->acciontipoId!='1'){
            $this->accionproducto=Accion::find($this->accionproducto_id);
        }else{
            $this->accionproducto=Producto::find($this->accionproducto_id);
        }
        $this->preciotarifa_ud=$this->accionproducto->preciotarifa;
        $this->udpreciotarifa_id=$this->accionproducto->udpreciotarifa_id;


        $this->unidadventa=$this->accionproducto->unidadpreciotarifa->nombrecorto;
        $this->calculoPrecioVenta();
    }

    public function UpdatedUnidades(){
        $this->validate([
            'unidades'=>'numeric',
        ]);
        $this->calculoPrecioVenta();
    }

    public function UpdatedAncho(){
        $this->validate([
            'ancho'=>'numeric',
        ]);
        $this->calculoPrecioVenta();
    }
    public function UpdatedAlto(){
        $this->validate([
            'alto'=>'numeric',
        ]);
        $this->calculoPrecioVenta();
    }

    public function UpdatedFactor()
    {
        $this->validate([
            'factor'=>'numeric',
        ]);

        if($this->factor<$this->factormin){
            $this->dispatchBrowserEvent("notify", "El factor es inferior al mínimo. Se asignará el mínimo.");
            $this->factor=$this->empresaTipo->factormin ?? '1';
        }
        $this->calculoPrecioVenta();

    }

    public function changeVisible(PresupuestoLineaDetalle $presupaccion,$visible)
    {
        $visible=$visible==false ? true : false;
        Validator::make(['visible'=>$visible],[
            'visible'=>'boolean',
        ])->validate();
        $presupaccion->update(['visible'=>$visible]);
        $this->dispatchBrowserEvent('notify', 'Visible Actualizado.');
    }

    public function changeOrden(PresupuestoLineaDetalle $presupaccion,$orden)
    {
        Validator::make(['orden'=>$orden],[
            'orden'=>'numeric',
        ])->validate();
        $presupaccion->update(['orden'=>$orden]);
        $this->dispatchBrowserEvent('notify', 'Orden Actualizado.');
        $this->emit('linearefresh');
    }

    public function changeDescripcion(PresupuestoLineaDetalle $presupaccion,$descripcion)
    {
        Validator::make(['descripcion'=>$descripcion],[
            'descripcion'=>'required',
        ])->validate();
        $presupaccion->update(['descripcion'=>$descripcion]);
        $this->dispatchBrowserEvent('notify', 'Descripción Actualizada.');
    }

    public function changeObs(PresupuestoLineaDetalle $presupaccion,$observaciones)
    {
        $presupaccion->update(['observaciones'=>$observaciones]);
        $this->dispatchBrowserEvent('notify', 'Observación Actualizada.');
    }

    public function changeAncho(PresupuestoLineaDetalle $presupaccion,$ancho)
    {
        Validator::make(['ancho'=>$ancho],[
            'ancho'=>'numeric|required',
        ])->validate();
        $presupaccion->update([
            'ancho'=>$ancho,
            'metros2'=>round($ancho * $presupaccion->alto ,2),
            'preciotarifa'=>round($ancho * $presupaccion->alto * $presupaccion->preciotarifa_ud * $presupaccion->unidades,2),
            'precioventa'=>round($ancho * $presupaccion->alto * $presupaccion->preciotarifa_ud * $presupaccion->factor * $presupaccion->unidades,2),
        ]);
        $this->recalcular($presupaccion);

        $this->dispatchBrowserEvent('notify', 'Ancho y Precio Venta actualizados.');

    }

    public function changeAlto(PresupuestoLineaDetalle $presupaccion,$alto)
    {
        Validator::make(['alto'=>$alto],[
            'alto'=>'numeric|required',
        ])->validate();
        $presupaccion->update([
            'alto'=>$alto,
            'metros2'=>round($alto * $presupaccion->ancho ,2),
            'preciotarifa'=>round($alto * $presupaccion->ancho * $presupaccion->preciotarifa_ud * $presupaccion->unidades,2),
            'precioventa'=>round($alto * $presupaccion->ancho * $presupaccion->preciotarifa * $presupaccion->factor * $presupaccion->unidades,2),
        ]);

        $this->recalcular($presupaccion);

        $this->dispatchBrowserEvent('notify', 'Alto y Precio Venta Actualizados.');
    }

    public function changeUnidades(PresupuestoLineaDetalle $presupaccion,$unidades)
    {
        Validator::make(['unidades'=>$unidades],[
            'unidades'=>'numeric|required',
        ])->validate();
        $presupaccion->update([
            'unidades'=>$unidades,
            'preciotarifa'=>round($presupaccion->ancho * $presupaccion->alto * $presupaccion->preciotarifa_ud * $unidades,2),
            'precioventa'=>round($presupaccion->ancho * $presupaccion->alto * $presupaccion->preciotarifa_ud * $presupaccion->factor * $unidades,2),
        ]);
        $this->recalcular($presupaccion);
        $this->dispatchBrowserEvent('notify', 'Unidades y Precio Venta Actualizados.');
    }

    public function changeFactor(PresupuestoLineaDetalle $presupaccion,$factor)
    {
        Validator::make(['factor'=>$factor],[
            'factor'=>'numeric|required',
            ])->validate();
        $factormin=$presupaccion->presupuestolinea->presupuesto->entidad->empresatipo->factormin ?? '1';
        if($factor<$factormin){
            $this->dispatchBrowserEvent("notify", "El factor es inferior al mínimo. Se asignará el mínimo.");
            $factor=$factormin;
        }
        $presupaccion->update([
            'factor'=>$factor,
            'preciotarifa'=>round($presupaccion->ancho * $presupaccion->alto * $presupaccion->preciotarifa_ud * $presupaccion->unidades ,2),
            'precioventa'=>round($presupaccion->ancho * $presupaccion->alto * $presupaccion->preciotarifa_ud * $presupaccion->unidades * $factor,2),
        ]);

        $this->recalcular($presupaccion);

        $this->dispatchBrowserEvent('notify', 'Unidades y Precio Venta Actualizados.');
    }

    public function save()
    {
        $this->validate();

        $pldetalle = PresupuestoLineaDetalle::create( [
            'presupuestolinea_id'=>$this->presuplinea->id,
            'acciontipo_id'=>$this->acciontipoId,
            'accionproducto_id'=>$this->accionproducto_id,
            'orden'=>$this->orden,
            'descripcion'=>$this->descripcion,
            'preciotarifa'=>$this->preciotarifa,
            'preciotarifa_ud'=>$this->preciotarifa_ud,
            'udpreciotarifa_id'=>$this->udpreciotarifa_id,
            'precioventa'=>$this->precioventa,
            'factor'=>$this->factor,
            'unidades'=>$this->unidades,
            'alto'=>$this->alto,
            'ancho'=>$this->ancho,
            'metros2'=>$this->metros2,
            'observaciones'=>$this->observaciones,
        ]);

        $this->recalcular($pldetalle);

        return redirect()->route('presupuestolinea.create',[$this->presuplinea,$this->acciontipo->id]);
    }

    public function recalcular($presupaccion)
    {
        $pl=PresupuestoLinea::find($presupaccion->presupuestolinea_id);
        $pl->recalculo();
        $p=Presupuesto::find($pl->presupuesto_id);
        $p->recalculo();
        return redirect()->route('presupuestolinea.create',[$pl,$presupaccion->acciontipo_id]);
    }

    public function calculoPrecioVenta()
    {
        if($this->unidadventa=='m2' || $this->unidadventa=='pla'){
            $this->showAnchoAlto = true;
        }else{
            $this->alto='1';
            $this->ancho='1';
            $this->showAnchoAlto= false;
        }
        $this->metros2=round($this->ancho * $this->alto ,2);
        $this->preciotarifa=round($this->metros2 * $this->preciotarifa_ud * $this->unidades,2);
        $this->precioventa=round($this->metros2 * $this->preciotarifa_ud * $this->factor * $this->unidades,2);
    }

    public function delete($lineaId)
    {
        $lineaBorrar = PresupuestoLineaDetalle::find($lineaId);

        if ($lineaBorrar) {
            $lineaBorrar->delete();
            $this->recalcular($lineaBorrar);
            $this->dispatchBrowserEvent('notify', 'Linea de presupuesto eliminada!');
        }
    }
}
