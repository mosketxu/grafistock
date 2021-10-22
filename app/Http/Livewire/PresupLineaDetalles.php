<?php

namespace App\Http\Livewire;

use App\Models\{Presupuesto, PresupuestoLineaDetalle,Producto,Accion, PresupuestoLinea};
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class PresupLineaDetalles extends Component
{
    public $presupuestolinea;

    protected $listeners = [ 'presuplineadetallesrefresh' => '$refresh'];

    public function render()
    {
        $presuplineadetalles=PresupuestoLineaDetalle::where('presupuestolinea_id',$this->presupuestolinea->id)->get();
        $presupproductos=$presuplineadetalles->where('acciontipo_id','1');
        $presupimpresion=$presuplineadetalles->where('acciontipo_id','2');
        $presupacabados=$presuplineadetalles->where('acciontipo_id','3');
        $presupmanipulados=$presuplineadetalles->where('acciontipo_id','4');
        $presupembalajes=$presuplineadetalles->where('acciontipo_id','5');
        $presuptransportes=$presuplineadetalles->where('acciontipo_id','6');
        $presupexternos=$presuplineadetalles->where('acciontipo_id','7');

        $productos=Producto::orderBy('descripcion')->get();

        $acciones=Accion::orderBy('acciontipo_id')->orderBy('descripcion')->get();
        $impresion=$acciones->where('acciontipo_id','2');
        $acabados=$acciones->where('acciontipo_id','3');
        $manipulados=$acciones->where('acciontipo_id','4');
        $embalajes=$acciones->where('acciontipo_id','5');
        $transportes=$acciones->where('acciontipo_id','6');
        $externos=$acciones->where('acciontipo_id','7');

        $presuplinea=$this->presupuestolinea;
        return view('livewire.presup-linea-detalles',compact(['presupproductos','presupimpresion','presupacabados','presupmanipulados','presupembalajes','presuptransportes','presupexternos','productos','impresion','acabados','manipulados','embalajes','transportes','externos','presuplinea']));
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
        $this->emit('presuplineadetallesrefresh');

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

        // $this->emit('presupuestorefresh');
        // $this->emit('linearefresh');
        $this->emit('presuplineadetallesrefresh');

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

}
