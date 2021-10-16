<?php

namespace App\Http\Livewire;

use App\Models\{PedidoDetalle, Presupuesto, PresupuestoLinea,PresupuestoLineaDetalle};
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class PresupLineas extends Component
{

    public $presupuesto;

    protected $listeners = [ 'linearefresh' => '$refresh'];

    public function render()
    {
        $lineas=PedidoDetalle::where('presupuesto_id',$this->presupuesto->id)->orderBy('orden');
        return view('livewire.presup-lineas',compact(['lineas']));
    }

    public function changeVisible(PresupuestoLinea $linea,$visible)
    {
        $visible=$visible==false ? true : false;
        Validator::make(['visible'=>$visible],[
            'visible'=>'boolean',
        ])->validate();
        $linea->update(['visible'=>$visible]);
        $this->dispatchBrowserEvent('notify', 'Visible Actualizado.');
    }

    public function changeOrden(PresupuestoLinea $linea,$orden)
    {
        Validator::make(['orden'=>$orden],[
            'orden'=>'numeric',
        ])->validate();
        $linea->update(['orden'=>$orden]);
        $this->dispatchBrowserEvent('notify', 'Orden Actualizado.');
        $this->emit('linearefresh');
    }

    public function changeDescripcion(PresupuestoLinea $linea,$descripcion)
    {
        Validator::make(['descripcion'=>$descripcion],[
            'descripcion'=>'required',
        ])->validate();
        $linea->update(['descripcion'=>$descripcion]);
        $this->dispatchBrowserEvent('notify', 'Descripción Actualizada.');
    }


    public function changeUnidades(PresupuestoLinea $linea,$unidades)
    {
        Validator::make(['unidades'=>$unidades],[
            'unidades'=>'numeric|nullable',
        ])->validate();
        $linea->update(['unidades'=>$unidades]);

        $p=Presupuesto::find($this->presupuesto->id)->recalculo();
        $this->emit('presupuestorefresh');
        $this->emit('linearefresh');
        $this->dispatchBrowserEvent('notify', 'Unidades Actualizadas.');
    }

    public function changeVenta(PresupuestoLinea $linea,$precioventa)
    {
        Validator::make(['precioventa'=>$precioventa],[
            'precioventa'=>'numeric|nullable',
        ])->validate();
        $linea->update(['precioventa'=>$precioventa]);
        $p=Presupuesto::find($this->presupuesto->id)->recalculo();
        // $this->recalculo();
        $this->emit('presupuestorefresh');
        $this->emit('linearefresh');
        $this->dispatchBrowserEvent('notify', 'Precio Venta Actualizado.');
    }

    public function changeObs(PresupuestoLinea $linea,$observaciones)
    {
        Validator::make(['observaciones'=>$observaciones],[
            'observaciones'=>'text|nullable',
        ])->validate();
        $linea->update(['observaciones'=>$observaciones]);
        $this->dispatchBrowserEvent('notify', 'Observaciones Actualizado.');
    }

    // public function recalculo()
    // {
    //     $this->presupuesto->precioventa=$this->presupuesto->presupuestolineas->sum('precioventa');
    //     $this->presupuesto->preciocoste=$this->presupuesto->presupuestolineas->sum('preciocoste');
    //     $this->presupuesto->save();
    // }

    public function delete($lineaId)
    {
        $lineaBorrar = PresupuestoLinea::find($lineaId);

        if ($lineaBorrar) {
            $lineasdetalle = PresupuestoLineaDetalle::where('presupuestolinea_id', $lineaBorrar->id)->delete();
            $lineaBorrar->delete();
            $this->dispatchBrowserEvent('notify', 'Detalle de presupuesto eliminado!');
            $this->emit('linearefresh');
        }
    }
}
