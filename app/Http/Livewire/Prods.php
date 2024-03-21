<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
use App\Models\Producto;
use App\Models\ProductoAcabado;
use App\Models\ProductoFamilia;
use App\Models\ProductoMaterial;
use App\Models\ProductoTipo;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;


use Livewire\Component;

class Prods extends Component
{

    use WithPagination;

    public $search='';
    public $filtrofamilia='';
    public $filtrotipo='';
    public $filtromaterial='';
    public $filtroclipro='';
    public $filtroacabado='';
    public $filtrogrupoprod='';
    public $filtroactivo='';

    public Producto $producto;


    public function render(){
        $this->producto= new Producto;
        $proveedores=Entidad::orderBy('entidad')->has('productos')->get();

        $materiales= Producto::query()
            ->join('producto_materiales','producto_materiales.id','=','productos.material_id')
            ->select('producto_materiales.id', 'producto_materiales.nombre')
            ->groupBy('material_id')
            ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
            ->when($this->filtrofamilia!='', function ($query){$query->where('familia_id',$this->filtrofamilia);})
            ->when($this->filtroacabado!='', function ($query){$query->where('acabado_id',$this->filtroacabado);})
            ->when($this->filtrotipo!='', function ($query){$query->where('tipo_id',$this->filtrotipo);})
            ->orderBy('producto_materiales.nombre')
            ->get();

        $familias= Producto::query()
                ->join('producto_familias','producto_familias.id','=','productos.familia_id')
                ->select('producto_familias.id', 'producto_familias.nombre')
                ->groupBy('familia_id')
                ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
                ->when($this->filtromaterial!='', function ($query){$query->where('material_id',$this->filtromaterial);})
                ->when($this->filtroacabado!='', function ($query){$query->where('acabado_id',$this->filtroacabado);})
                ->when($this->filtrotipo!='', function ($query){$query->where('tipo_id',$this->filtrotipo);})
                ->orderBy('producto_familias.nombre')
                ->get();

        $acabados= Producto::query()
                ->join('producto_acabados','producto_acabados.id','=','productos.acabado_id')
                ->select('producto_acabados.id', 'producto_acabados.nombre')
                ->groupBy('acabado_id')
                ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
                ->when($this->filtromaterial!='', function ($query){$query->where('material_id',$this->filtromaterial);})
                ->when($this->filtrofamilia!='', function ($query){$query->where('familia_id',$this->filtrofamilia);})
                ->when($this->filtrotipo!='', function ($query){$query->where('tipo_id',$this->filtrotipo);})
                ->orderBy('producto_acabados.nombre')
                ->get();

        $tipos= Producto::query()
                ->join('producto_tipos','producto_tipos.id','=','productos.tipo_id')
                ->select('producto_tipos.id', 'producto_tipos.nombre')
                ->groupBy('tipo_id')
                ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
                ->when($this->filtromaterial!='', function ($query){$query->where('material_id',$this->filtromaterial);})
                ->when($this->filtroacabado!='', function ($query){$query->where('acabado_id',$this->filtroacabado);})
                ->when($this->filtrofamilia!='', function ($query){$query->where('familia_id',$this->filtrofamilia);})
                ->orderBy('producto_tipos.nombre')
                ->get();

        $tipostodos=ProductoTipo::orderBy('nombre')->get();
        $familiastodas=ProductoFamilia::orderBy('nombre')->get();
        $materialestodos=ProductoMaterial::orderBy('nombre')->get();
        $acabadostodos=ProductoAcabado::orderBy('nombre')->get();

        $productos=Producto::query()
            ->with('entidad','material','acabado','tipo')
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
            ->when($this->filtrotipo!='', function ($query){
                $query->where('tipo_id',$this->filtrotipo);
                })
            ->when($this->filtroactivo!='', function ($query){
                $query->where('activo',$this->filtroactivo);
                })
            ->orderBy('referencia','asc')
            ->paginate(15);

        return view('livewire.prods',compact('productos','familias','materiales','acabados','proveedores','tipos','familiastodas','tipostodos','materialestodos','acabadostodos'));
    }

    public function updatingSearch(){$this->resetPage();}
    public function updatingFiltroclipro(){$this->resetPage();}
    public function updatingFiltrofamilia(){$this->resetPage();}
    public function updatingFiltrotipo(){$this->resetPage();}
    public function updatingFiltromaterial(){$this->resetPage();}
    public function updatingFiltroacabado(){$this->resetPage();}
    public function updatingFiltrogrupoprod(){$this->resetPage();}

    public function changeValor(Producto $producto,$campo,$valor){


        $material = $campo=='material_id' ? ProductoMaterial::find($valor)->nombrecorto : $producto->material->nombrecorto ?? '';
        $tipo = $campo=='tipo_id' ? ProductoTipo::find($valor)->nombrecorto : $producto->tipo->nombrecorto ?? '';
        $acabado = $campo=='acabado_id' ? ProductoAcabado::find($valor)->nombrecorto : $producto->acabado->nombrecorto ?? '';
        $p=Entidad::find($producto->entidad_id)->id;
        $referencia=$tipo.'-'.$material.'-'.str_pad($producto->grosor_mm, 4, '0', STR_PAD_LEFT).'-'.str_pad($producto->ancho, 4, '0', STR_PAD_LEFT).'-'.str_pad($producto->alto, 4, '0', STR_PAD_LEFT).'-'.$acabado.'-'.$p;

        $existeref=0;
        $existeref=Producto::where('referencia',$referencia)->count();

        if(!$existeref>0){
            $producto->update([$campo=>$valor,'referencia'=>$referencia]);
            $this->dispatchBrowserEvent('notify', 'Actualizada con éxito.');
        }
        else{
            $this->producto->$campo=$producto->campo;
            $this->dispatchBrowserEvent('notifyred', 'Esta referencia ya existe. No se modificarán los datos');
        }
    }

    public function presentaPDF(Producto $producto){
        $existe=Storage::disk('fichasproducto')->exists($producto->fichaproducto);
        if ($existe)
            return Storage::disk('fichasproducto')->download($producto->fichaproducto);
    }

    public function favorito($producto){
        $p=Producto::find($producto['id']);
        $p->favorito=$p->favorito=='1' ? '0' : '1';
        $p->save();
    }

    public function activo($producto){
        $p=Producto::find($producto['id']);
        $p->activo=$p->activo=='1' ? '0' : '1';
        $p->save();
    }

    public function delete($productoId){
        $producto = Producto::find($productoId);
        if ($producto) {
            $producto->delete();
            $this->dispatchBrowserEvent('notify', 'El producto: '.$producto->referencia.' ha sido eliminado!');
        }
    }
}
