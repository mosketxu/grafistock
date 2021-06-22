<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
use App\Models\Producto;
use App\Models\ProductoAcabado;
use App\Models\ProductoGrupoproduccion;
use App\Models\ProductoMaterial;
use Livewire\WithPagination;


use Livewire\Component;

class Prods extends Component
{

    use WithPagination;

    public $search='';
    public $filtromaterial='';
    public $filtroproveedor='';
    public $filtroacabado='';
    public $filtrogrupoprod='';

    public Producto $producto;


    public function render()
    {
        $this->producto= new Producto;
        $materiales=ProductoMaterial::orderBy('nombre')->get();
        $acabados=ProductoAcabado::orderBy('nombre')->get();
        $gruposprod=ProductoGrupoproduccion::orderBy('nombre')->get();
        $proveedores=Entidad::orderBy('entidad')->get();
        // dd($proveedores->first());
        $productos=Producto::query()
            ->search('referencia',$this->search)
            ->when($this->filtromaterial!='', function ($query){
                $query->where('material_id',$this->filtromaterial);
                })
            ->when($this->filtroproveedor!='', function ($query){
                $query->where('entidad_id',$this->filtroproveedor);
                })
            ->when($this->filtroacabado!='', function ($query){
                $query->where('acabado_id',$this->filtroacabado);
                })
            ->when($this->filtrogrupoprod!='', function ($query){
                $query->where('grupoproduccion_id',$this->filtrogrupoprod);
                })
            ->orderBy('referencia','asc')
            ->paginate(10);
        return view('livewire.prods',compact('productos','materiales','acabados','gruposprod','proveedores'));
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
