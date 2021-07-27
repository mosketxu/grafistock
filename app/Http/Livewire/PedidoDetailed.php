<?php

namespace App\Http\Livewire;

use App\Models\{PedidoDetalle,Pedido, Producto};
use Illuminate\Support\Facades\Validator;
use Livewire\Component;


class PedidoDetailed extends Component
{
    public $pedido;
    public $base;
    public $totaliva;
    public $total;
    public $showcrear=false;

    protected $listeners = [ 'showNuevoDetalle'=>'showNuevoDetalle', 'detallerefresh' => '$refresh'];

    public function render()
    {
        $pedido=$this->pedido;
        $this->showcrear=$this->pedido->id ? true : false;
        $this->base=$pedido->pedidodetalles->sum('base');
        $this->totaliva=$pedido->pedidodetalles->sum('totaliva');
        $this->total=$pedido->pedidodetalles->sum('total');

        $detalles = PedidoDetalle::where('pedido_id', $this->pedido->id)
            ->with('producto','unidadcompra')
            ->orderBy('orden')
            ->get();

        return view('livewire.pedido-detailed', compact('pedido','detalles'));
    }

    // public function showNuevoDetalle()
    // {
    //     $this->showcrear=1;
    //     $this->emit('detallerefresh');
    // }

    public function changeOrden(PedidoDetalle $detalle,$orden)
    {
        Validator::make(['orden'=>$orden],[
            'orden'=>'numeric',
        ])->validate();
        $detalle->update(['orden'=>$orden]);
        $this->dispatchBrowserEvent('notify', 'Orden Actualizado.');
    }

    public function changeCantidad(PedidoDetalle $detalle,$cantidad)
    {
        Validator::make(['cantidad'=>$cantidad],[
            'cantidad'=>'numeric',
        ])->validate();
        $detalle->update(['cantidad'=>$cantidad]);
        $this->dispatchBrowserEvent('notify', 'Cantidad Actualizada.');
    }

    public function changeCoste(PedidoDetalle $detalle,$coste)
    {
        Validator::make(['coste'=>$coste],[
            'coste'=>'numeric',
        ])->validate();
        $detalle->update(['coste'=>$coste]);
        $this->dispatchBrowserEvent('notify', 'Coste Actualizado.');
    }

    public function delete($detallepedidoId)
    {
        $pedidodetalleBorrar = PedidoDetalle::find($detallepedidoId);

        if ($pedidodetalleBorrar) {
            $pedidodetalleBorrar->delete();
            $this->dispatchBrowserEvent('notify', 'Detalle de pedido eliminado!');
        }
    }


}
