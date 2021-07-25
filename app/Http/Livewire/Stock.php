<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{PedidoDetalle, Stock as ModelsStock,Producto, Entidad, Pedido, User};


class Stock extends Component
{
    public $stock;
    public $message;

    protected function rules(){
        return [
            'stock.id'=>'nullable',
            'stock.user_id'=>'required',
            'stock.fechamovimiento'=>'date|required',
            'stock.tipomovimiento'=>'required',
            'stock.cantidad'=>'required',
            'stock.producto_id'=>'required',
            'stock.reentrada'=>'nullable',
            'stock.observaciones'=>'nullable',
        ];
    }

    public function mount(ModelsStock $stock)
    {
        $this->stock=$stock;
        $this->stock->reentrada=false;
        $this->stock->fechamovimiento=now();

    }

    public function render()
    {
        $productos=Producto::whereHas('pedidodetalles')->orderBy('referencia')->get();
        $usuarios=User::orderBy('name')->get();
        return view('livewire.stock', compact('productos','usuarios'));
    }

    // public function updatedstockProductoId()
    // {

    // }

    public function save()
    {
        $this->validate();

        $c = $this->stock->tipomovimiento =='E' ? $this->stock->cantidad : -$this->stock->cantidad;

        $s=ModelsStock::updateOrCreate([
            'id'=>$this->stock->id
            ],
            [
            'user_id'=>$this->stock->user_id,
            'fechamovimiento'=>$this->stock->fechamovimiento,
            'tipomovimiento'=>$this->stock->tipomovimiento,
            'cantidad'=>$c,
            'producto_id'=>$this->stock->producto_id,
            'reentrada'=>$this->stock->reentrada,
            'observaciones'=>$this->stock->observaciones,
            ]
        );


        $this->stock->id=null;
        $this->stock->user_id=null;
        // $this->stock->fechamovimiento=null;
        $this->stock->tipomovimiento=null;
        $this->stock->cantidad=null;
        $this->stock->producto_id=null;
        $this->stock->reentrada=null;
        $this->stock->observaciones=null;
        $this->stock->reentrada=false;

        $mensaje="Operacion realizada satisfactoriamente";
        $this->dispatchBrowserEvent('notify', $mensaje);
    }

    public function cancelar()
    {
        $this->stock->id=null;
        $this->stock->user_id=null;
        $this->stock->fechamovimiento=null;
        $this->stock->tipomovimiento=null;
        $this->stock->cantidad=null;
        $this->stock->producto_id=null;
        $this->stock->reentrada=null;
        $this->stock->observaciones=null;
        $this->stock->reentrada=false;

    }

}
