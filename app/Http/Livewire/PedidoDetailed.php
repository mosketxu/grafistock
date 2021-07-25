<?php

namespace App\Http\Livewire;

use App\Models\{PedidoDetalle,Pedido, Producto};
use Livewire\Component;


class PedidoDetailed extends Component
{
    public $pedido;
    public $base;
    public $totaliva;
    public $total;
    public $showcrear=false;

    protected $listeners = [ 'showNuevoDetalle'=>'funshowdetalle', 'detallerefresh' => '$refresh'];

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

        $bloqueado=$this->pedido->bloqueado;

        return view('livewire.pedido-detailed', compact('pedido','detalles','bloqueado'));
    }

    public function showNuevoDetalle()
    {
        $this->showcrear=1;
        $this->emit('detallerefresh');
    }

    public function saveDetalle($detallepedido)
    {
        // $this->validate();
        // $detalle = $this->pedidodetalle->id;
        // if (!is_null($detalle)) {
        //     $p=PedidoDetalle::find($detalle['id']);
        //     $p->orden=$detalle['orden'];
        //     $p->pedido_id=$detalle['pedido_id'];
        //     $p->producto_id=$detalle['producto_id'];
        //     $p->cantidad=$detalle['cantidad'];
        //     $p->coste=$detalle['coste'];
        //     $p->iva=$detalle['iva'];
        //     $p->save();
        // }
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
