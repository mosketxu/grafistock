<?php

namespace App\Http\Livewire;

use App\Models\{PresupuestoLineaDetalle,Producto,Accion, AccionTipo, Presupuesto, PresupuestoLinea};
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class PresupLineaDetalles extends Component
{
    public $presupuestolinea;

    protected $listeners = [ 'presuplineadetallesrefresh' => '$refresh'];

    public function render()
    {
        $presuplineadetalles=PresupuestoLineaDetalle::where('presupuestolinea_id',$this->presupuestolinea->id)->orderBy('orden')->get();
        $presupproductos=$presuplineadetalles->where('acciontipo_id','1');
        $presupimpresion=$presuplineadetalles->where('acciontipo_id','2');
        $presupacabados=$presuplineadetalles->where('acciontipo_id','3');
        $presupmanipulados=$presuplineadetalles->where('acciontipo_id','4');
        $presupembalajes=$presuplineadetalles->where('acciontipo_id','5');
        $presuptransportes=$presuplineadetalles->where('acciontipo_id','6');
        $presupexternos=$presuplineadetalles->where('acciontipo_id','7');

        $productos=Producto::orderBy('descripcion')->get();

        $acciones=Accion::orderBy('acciontipo_id')->orderBy('descripcion')->get();
        $acciontipos=AccionTipo::orderBy('id')->get();
        $presuplinea=$this->presupuestolinea;
        return view('livewire.presup-linea-detalles',compact(['acciontipos','acciones','presuplineadetalles','presuplinea']));
    }

    public function changeVisible(PresupuestoLineaDetalle $presupaccion,$visible)
    {
        $visible=$visible==false ? true : false;
        Validator::make(['visible'=>$visible],[
            'visible'=>'boolean',
        ])->validate();
        $presupaccion->update(['visible'=>$visible]);
        $this->dispatchBrowserEvent('notify', 'Visible actualizado.');
    }

    public function changeOrden(PresupuestoLineaDetalle $presupaccion,$orden)
    {
        Validator::make(['orden'=>$orden],[
            'orden'=>'numeric',
        ])->validate();
        $presupaccion->update(['orden'=>$orden]);
        $this->dispatchBrowserEvent('notify', 'Orden Actualizado.');
    }

    public function changeDescripcion(PresupuestoLineaDetalle $presupaccion,$descripcion)
    {
        Validator::make(['descripcion'=>$descripcion],[
            'descripcion'=>'required',
        ])->validate();
        $presupaccion->update(['descripcion'=>$descripcion]);
        $this->dispatchBrowserEvent('notify', 'Descripción Actualizado.');
    }

    public function changeAncho(PresupuestoLineaDetalle $presupaccion,$ancho)
    {
        Validator::make(['ancho'=>$ancho],[
            'ancho'=>'numeric|required',
        ])->validate();
        $presupaccion->update([
            'ancho'=>$ancho,
            'metros2'=>round($ancho * $presupaccion->alto,2),
        ]);
        $this->calculoPrecioVenta($presupaccion);
    }

    public function changeAlto(PresupuestoLineaDetalle $presupaccion,$alto)
    {
        Validator::make(['alto'=>$alto],[
            'alto'=>'numeric|required',
        ])->validate();
        $presupaccion->update([
            'alto'=>$alto,
            'metros2'=>round($alto * $presupaccion->ancho,2),
        ]);
        $this->calculoPrecioVenta($presupaccion);
    }

    public function changeFactor(PresupuestoLineaDetalle $presupaccion,$factor)
    {
        Validator::make(['factor'=>$factor],[
            'factor'=>'numeric|required',
        ])->validate();

        $p=Presupuesto::find($presupaccion->presupuestolinea_id);
        $factormin=$p->entidad->empresatipo->factormin;
        if($factor<$factormin){
            $this->dispatchBrowserEvent("notify", "El factor es inferior al mínimo. Se asignará el mínimo.");
            $factor=$factormin ?? '1';
        }
        $presupaccion->update([
            'factor'=>$factor,
        ]);
        $this->calculoPrecioVenta($presupaccion);
    }

    public function changeUnidades(PresupuestoLineaDetalle $presupaccion,$unidades)
    {
        Validator::make(['unidades'=>$unidades],[
            'unidades'=>'numeric|nullable',
            ])->validate();
        $presupaccion->update(['unidades'=>$unidades]);
        $this->calculoPrecioVenta($presupaccion);

        $p=PresupuestoLinea::find($this->presupuestolinea->id)->recalculo();
    }

    public function changeObs(PresupuestoLineaDetalle $presupaccion,$observaciones)
    {
        Validator::make(['observaciones'=>$observaciones],[
            'observaciones'=>'text|nullable',
        ])->validate();
        $presupaccion->update(['observaciones'=>$observaciones]);
    }

    public function calculoPrecioVenta($presupacciondetalle)
    {
        $presupacciondetalle->precioventa=round($presupacciondetalle->metros2 * $presupacciondetalle->preciotarifa * $presupacciondetalle->factor * $presupacciondetalle->unidades,2);
        $presupacciondetalle->save();
        $this->dispatchBrowserEvent('notify', 'Precio venta actualizado.');
    }

    public function save($presupacciondetalle)
    {
        // $this->validate();
        $pl=$presupacciondetalle->recalculo();
        $p=Presupuesto::find($presupacciondetalle->presupuesto_id);
        $p->recalculo();

        // return redirect()->route('presupuestolinea.create',[$this->presuplinea,$this->acciontipo->id]);
    }

    public function delete($lineaId)
    {
        $lineaBorrar = PresupuestoLineaDetalle::find($lineaId);

        if ($lineaBorrar) {
            $lineaBorrar->delete();
            $this->dispatchBrowserEvent('notify', 'Linea de presupuesto eliminada!');
            $this->emit('linearefresh');
        }
    }
}
