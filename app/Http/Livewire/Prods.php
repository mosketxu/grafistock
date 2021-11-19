<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
use App\Models\Producto;
use App\Models\ProductoAcabado;
use App\Models\ProductoFamilia;
use App\Models\ProductoGrupoproduccion;
use App\Models\ProductoMaterial;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;


use Livewire\Component;

class Prods extends Component
{

    use WithPagination;

    public $search='';
    public $filtrofamilia='';
    public $filtromaterial='';
    public $filtroclipro='';
    public $filtroacabado='';
    public $filtrogrupoprod='';

    public Producto $producto;


    public function render()
    {
        $this->producto= new Producto;
        $proveedores=Entidad::orderBy('entidad')->has('productos')->get();

        // $materiales = ProductoMaterial::query()
        //     ->whereIn('id', function ($query) {
        //         $query->select('material_id')->from('productos');
        //         })
        //     ->orderBy('nombre')
        //     ->get();

        $materiales= Producto::query()
            ->join('producto_materiales','producto_materiales.id','=','productos.material_id')
            ->select('producto_materiales.id', 'producto_materiales.nombre')
            ->groupBy('material_id')
            ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
            ->when($this->filtrofamilia!='', function ($query){$query->where('familia_id',$this->filtrofamilia);})
            ->when($this->filtroacabado!='', function ($query){$query->where('acabado_id',$this->filtroacabado);})
            ->get();

        $familias= Producto::query()
                ->join('producto_familias','producto_familias.id','=','productos.familia_id')
                ->select('producto_familias.id', 'producto_familias.nombre')
                ->groupBy('familia_id')
                ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
                ->when($this->filtromaterial!='', function ($query){$query->where('material_id',$this->filtromaterial);})
                ->when($this->filtroacabado!='', function ($query){$query->where('acabado_id',$this->filtroacabado);})
                ->get();

        $acabados= Producto::query()
                ->join('producto_acabados','producto_acabados.id','=','productos.acabado_id')
                ->select('producto_acabados.id', 'producto_acabados.nombre')
                ->groupBy('acabado_id')
                ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
                ->when($this->filtromaterial!='', function ($query){$query->where('material_id',$this->filtromaterial);})
                ->when($this->filtrofamilia!='', function ($query){$query->where('familia_id',$this->filtrofamilia);})
                ->get();


        $productos=Producto::query()
            ->with('entidad:entidad','material:nombre','acabado:nombre','tipo:nombre')
            ->search('referencia',$this->search)
            ->orSearch('descripcion',$this->search)
            ->when($this->filtrofamilia!='', function ($query){
                $query->where('familia_id',$this->filtrofamilia);
                })
            ->when($this->filtromaterial!='', function ($query){
                $query->where('material_id',$this->filtromaterial);
                })
            ->when($this->filtroclipro!='', function ($query){
                $query->where('entidad_id',$this->filtroclipro);
                })
            ->when($this->filtroacabado!='', function ($query){
                $query->where('acabado_id',$this->filtroacabado);
                })
            ->when($this->filtrogrupoprod!='', function ($query){
                $query->where('grupoproduccion_id',$this->filtrogrupoprod);
                })
            ->orderBy('referencia','asc')
            ->paginate(15);

            return view('livewire.prods',compact('productos','materiales','familias','acabados','proveedores'));
    }

    public function updatingFiltroclipro(){
        $this->resetPage();
    }
    public function updatingFiltrmaterial(){
        $this->resetPage();
    }
    public function updatingFiltroacabado(){
        $this->resetPage();
    }
    public function updatingFiltrogrupoprod(){
        $this->resetPage();
    }



    public function presentaPDF(Producto $producto){
        $existe=Storage::disk('fichasproducto')->exists($producto->fichaproducto);
        if ($existe)
            return Storage::disk('fichasproducto')->download($producto->fichaproducto);

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
