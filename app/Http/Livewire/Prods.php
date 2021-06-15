<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\WithPagination;


use Livewire\Component;

class Prods extends Component
{

    use WithPagination;

    public $search='';
    public Producto $producto;

    public function render()
    {
        $this->producto= new Producto;
        $productos=Producto::query()
            ->search('referencia',$this->search)
            ->orderBy('referencia','asc')
            ->paginate(10);

        return view('livewire.prods',compact('productos'));
    }

    public function delete($productoId)
    {
        $producto = Producto::find($productoId);
        if ($producto) {
            $producto->delete();
            $this->dispatchBrowserEvent('notify', 'El producto: '.$producto->referencia.' ha sido eliminado!');
        }
    }
}
