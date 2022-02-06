<?php

namespace App\Http\Livewire;

use App\Models\{PedidoDetalle, UnidadCoste};
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
        $unidadescoste=UnidadCoste::orderBy('nombre')->get();

        $detalles = PedidoDetalle::where('pedido_id', $this->pedido->id)
            ->with('producto','unidadcompra','producto.material')
            ->orderBy('orden')
            ->get();

        return view('livewire.pedido-detailed', compact('pedido','detalles','unidadescoste'));
    }

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
        $detalle->update(['total'=>$cantidad * $detalle->coste]);
        $detalle->pedido->recalculo();
        $this->dispatchBrowserEvent('notify', 'Cantidad Actualizada.');
    }

    public function changeCoste(PedidoDetalle $detalle,$coste)
    {
        Validator::make(['coste'=>$coste],[
            'coste'=>'numeric',
        ])->validate();
        $detalle->update(['coste'=>$coste]);
        $detalle->update(['total'=>$coste * $detalle->cantidad]);
        $detalle->pedido->recalculo();
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
