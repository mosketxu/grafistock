<?php

namespace App\Http\Livewire;

use App\Models\{Producto,Accion,AccionTipo,Presupuesto,PresupuestoLinea,PresupuestoLineaDetalle};
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class PresupLineaDetalle extends Component
{
    public $acciontipoId;
    public $presuplinea;
    public $presupuestolinea;
    public $presupuestolineadetalleId='';
    public $ratios;
    public AccionTipo $acciontipo;

    public $visible=true;
    public $orden=1;
    public $descripcion;
    public $preciotarifa=0;
    public $precioventa=0;
    public $ratio;
    public $unidades=1;
    public $accion_id;
    public $observaciones;

    protected $rules = [
        'visible'=>'',
        'orden'=>'nullable|numeric',
        'descripcion'=>'required',
        'preciotarifa'=>'nullable|numeric',
        'precioventa'=>'nullable|numeric',
        'ratio'=>'nullable|numeric',
        'unidades'=>'nullable|numeric',
        'accion_id'=>'required',
    ];

    protected $listeners = [ 'presuplineadetallerefresh' => '$refresh'];

    public function mount(PresupuestoLinea $presupuestolinea)
    {
        $this->presuplinea=$presupuestolinea;
        $this->ratios=$presupuestolinea->presupuesto->entidad->empresatipo;
        $this->ratio=$presupuestolinea->presupuesto->entidad->empresatipo->factormaterial ?? '1';

    }

    public function render()
    {
        $this->acciontipo=AccionTipo::find($this->acciontipoId);
        $presupacciones=PresupuestoLineaDetalle::where('presupuestolinea_id',$this->presuplinea->id)
        ->where('acciontipo_id',$this->acciontipoId)
        ->get();

        if($this->acciontipoId!='1')
            $acciones=Accion::where('acciontipo_id',$this->acciontipoId)->orderBy('descripcion')->get();
        else{
            $acciones=Producto::orderBy('descripcion')->get();
        }


        return view('livewire.presup-linea-detalle',compact('acciones','presupacciones'));
    }

    public function UpdatedUnidades(){
        $this->precioventa=round($this->preciotarifa*$this->unidades*$this->ratio,2);
    }
    public function UpdatedAccionId()
    {
        if($this->acciontipoId!='1'){
            $a=Accion::find($this->accion_id);
            $this->preciotarifa=$a->preciotarifa;
            $this->precioventa=round($this->preciotarifa*$this->unidades*$this->ratio,2);
        }else{
            $a=Producto::find($this->accion_id);
            $this->preciotarifa=$a->preciotarifa;
            $this->ratio=$this->ratios->factormaterial;
            $this->precioventa=round($this->preciotarifa*$this->unidades*$this->ratio,2);
        }
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


    public function changeUnidades(PresupuestoLineaDetalle $presupaccion,$unidades)
    {
        Validator::make(['unidades'=>$unidades],[
            'unidades'=>'numeric|nullable',
            ])->validate();
        $presupaccion->update(['unidades'=>$unidades]);

        $p=PresupuestoLinea::find($this->presupuestolinea->id)->recalculo();
        // $this->emit('presupuestorefresh');
        // $this->emit('linearefresh');
        $this->emit('presuplineadetallerefresh');

        $this->dispatchBrowserEvent('notify', 'Unidades Actualizadas.');
    }

    public function changeVenta(PresupuestoLineaDetalle $presupaccion,$precioventa)
    {
        Validator::make(['precioventa'=>$precioventa],[
            'precioventa'=>'numeric|nullable',
        ])->validate();
        $presupaccion->update(['precioventa'=>$precioventa]);
        $pl=PresupuestoLinea::find($this->presupuestolinea->id);
        $pl->recalculo();
        $p=Presupuesto::find($pl->presupuesto_id)->recalculo();

        $this->emit('presuplineadetallerefresh');

        $this->dispatchBrowserEvent('notify', 'Precio Venta Actualizado.');
    }

    public function changeObs(PresupuestoLineaDetalle $presupaccion,$observaciones)
    {
        Validator::make(['observaciones'=>$observaciones],[
            'observaciones'=>'text|nullable',
        ])->validate();
        $presupaccion->update(['observaciones'=>$observaciones]);
        $this->dispatchBrowserEvent('notify', 'Observaciones Actualizado.');
    }

    public function save()
    {
        $this->ratio= !$this->ratio ? 1 : $this->ratio;

        $this->validate();
        $pldetalle = PresupuestoLineaDetalle::create( [
            'acciontipo_id'=>$this->acciontipoId,
            'accion_id'=>$this->accion_id,
            'presupuestolinea_id'=>$this->presuplinea->id,
            'orden'=>$this->orden,
            'descripcion'=>$this->descripcion,
            'preciotarifa'=>$this->preciotarifa,
            'precioventa'=>$this->precioventa,
            'ratio'=>$this->ratio,
            'unidades'=>$this->unidades,
            'observaciones'=>$this->observaciones,
        ]);

        $pl=$this->presuplinea->recalculo();
        $p=Presupuesto::find($this->presuplinea->presupuesto_id);
        $p->recalculo();

        // $this->emit('presuplineadetallesrefresh');
        // $this->dispatchBrowserEvent('notify', 'Línea añadida con éxito');

        return redirect()->route('presupuestolinea.create',[$this->presuplinea,$this->acciontipo->id]);
    }

    public function delete($lineaId)
    {
        $lineaBorrar = PresupuestoLineaDetalle::find($lineaId);

        if ($lineaBorrar) {
            $lineaBorrar->delete();
            $this->dispatchBrowserEvent('notify', 'Linea de presupuesto eliminada!');
            $this->emit('linearefresh');
        }
        $pl=$this->presuplinea->recalculo();
        $p=Presupuesto::find($this->presuplinea->presupuesto_id);
        $p->recalculo();
        $this->emit('presuplineadetallesrefresh');

    }
}
