<?php

namespace App\Http\Livewire;

use App\Models\{DetallePedido,Pedido, Producto};
use Livewire\Component;


class PedidoDetalle extends Component
{
    public $pedido;
    public $base;
    public $totaliva;
    public $total;
    public $showcrear=false;

    protected $listeners = [ 'funshow'=>'funshowdetalle', 'detallerefresh' => '$refresh'];

    public function mount()
    {
        // $this->detalles = DetallePedido::where('pedido_id', $this->pedido->id)
        //     ->orderBy('orden')
        //     ->get()
        //     ->toArray();
    }


    public function render()
    {
        $pedido=$this->pedido;
        $this->showcrear=$this->pedido->id ? true : false;
        $this->base=$pedido->pedidodetalles->sum('base');
        $this->totaliva=$pedido->pedidodetalles->sum('totaliva');
        $this->total=$pedido->pedidodetalles->sum('total');

        $detalles = DetallePedido::where('pedido_id', $this->pedido->id)
            ->orderBy('orden')
            ->get();
        // dd($detalles->unidadcompra->nombre);

        return view('livewire.pedido-detalle', compact('pedido','detalles'));
    }

    public function funshowdetalle()
    {
        $this->showcrear=1;
        // dd($this->showcrear);
        $this->emit('detallerefresh');
    }

    public function saveDetalle($pedidodetalle)
    {
        // $this->validate();
        // $detalle = $this->pedidodetalle->id;
        // if (!is_null($detalle)) {
        //     $p=DetallePedido::find($detalle['id']);
        //     $p->orden=$detalle['orden'];
        //     $p->pedido_id=$detalle['pedido_id'];
        //     $p->producto_id=$detalle['producto_id'];
        //     $p->cantidad=$detalle['cantidad'];
        //     $p->coste=$detalle['coste'];
        //     $p->iva=$detalle['iva'];
        //     $p->save();
        // }
    }

    public function delete($pedidodetalleId)
    {
        $pedidodetalleBorrar = DetallePedido::find($pedidodetalleId);

        if ($pedidodetalleBorrar) {
            $pedidodetalleBorrar->delete();
            $this->dispatchBrowserEvent('notify', 'Detalle de pedido eliminado!');
        }
    }


}
