<?php

namespace App\Http\Livewire;

use App\Models\{PedidoDetalle, StockMovimiento,Producto, Entidad, Pedido, ProductoMaterial, Solicitante};
use Livewire\Component;

class StockEntrada extends Component
{

    public $stock;
    public $message;
    public $filtromaterial='';

    protected function rules(){
        return [
            'stock.id'=>'nullable',
            'stock.solicitante_id'=>'required',
            'stock.fechamovimiento'=>'date|required',
            'stock.tipomovimiento'=>'required',
            'stock.cantidad'=>'required',
            'stock.producto_id'=>'required',
            'stock.reentrada'=>'nullable',
            'stock.observaciones'=>'nullable',
        ];
    }

    public function mount(StockMovimiento $stock)
    {
        $this->stock=$stock;
        $this->stock->reentrada=false;
        if (!$stock->fechamovimiento)
            $this->stock->fechamovimiento=now();

    }

    public function render()
    {
        $materiales=ProductoMaterial::orderBy('nombre')->get();
        $productos=Producto::query()
            ->whereHas('pedidodetalles')
            ->when($this->filtromaterial!='', function ($query){
                $query->where('material_id',$this->filtromaterial);
            })
            ->orderBy('referencia')->get();
        $solicitantes=Solicitante::orderBy('nombre')->get();
        return view('livewire.stock-entrada', compact('productos','solicitantes','materiales'));
    }

    public function save()
    {
        $this->validate();

        $c = $this->stock->tipomovimiento =='S' ? $this->stock->cantidad : -$this->stock->cantidad;

        $s=StockMovimiento::updateOrCreate([
            'id'=>$this->stock->id
            ],
            [
            'solicitante_id'=>$this->stock->solicitante_id,
            'fechamovimiento'=>$this->stock->fechamovimiento,
            'tipomovimiento'=>$this->stock->tipomovimiento,
            'cantidad'=>$c,
            'producto_id'=>$this->stock->producto_id,
            'reentrada'=>$this->stock->reentrada,
            'observaciones'=>$this->stock->observaciones,
            ]
        );


        $this->stock->id=null;
        $this->stock->solicitante_id=null;
        // $this->stock->fechamovimiento=null;
        $this->filtromaterial=null;
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
        $this->stock->solicitante_id=null;
        $this->stock->fechamovimiento=null;
        $this->stock->tipomovimiento=null;
        $this->stock->cantidad=null;
        $this->stock->producto_id=null;
        $this->stock->reentrada=null;
        $this->stock->observaciones=null;
        $this->stock->reentrada=false;

    }
}
