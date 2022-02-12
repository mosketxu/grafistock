<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\{StockMovimiento,Entidad,Producto};
use Livewire\Component;
use App\Exports\StockBalanceExport;
use Maatwebsite\Excel\Facades\Excel;

class StockBalance extends Component
{
    use WithPagination;

    public $search='';
    public $filtroclipro='';
    public $filtromaterial='';
    public $filtrofamilia='';
    public $filtrotipo='';
    public $filtroacabado='';
    public $filtrodescripcion='';
    public $filtrosolicitante='';
    public $filtroanyo='';
    public $filtromes='';
    public $filtrofecha='';

    public $tipo='';
    public $titulo='';
    public $ordenacion='';

    public function mount($tipo)
    {
        $this->tipo=$tipo;
        if($tipo=='producto_id'){
            $this->titulo='Referencia';
            $this->ordenacion='referencia';
        }else{
            $this->titulo='Material';
            $this->ordenacion='material_id';
        }

    }

    public function render()
    {
        $proveedores=Entidad::whereHas('pedidos')->orderBy('entidad')->get();
        $materiales= Producto::query()
            ->join('producto_materiales','producto_materiales.id','=','productos.material_id')
            ->select('producto_materiales.id', 'producto_materiales.nombre')
            ->groupBy('material_id')
            ->search('referencia',$this->search)
            ->orSearch('descripcion',$this->search)
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
            ->search('referencia',$this->search)
            ->orSearch('descripcion',$this->search)
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
            ->search('referencia',$this->search)
            ->orSearch('descripcion',$this->search)
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
            ->search('referencia',$this->search)
            ->orSearch('descripcion',$this->search)
            ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
            ->when($this->filtromaterial!='', function ($query){$query->where('material_id',$this->filtromaterial);})
            ->when($this->filtroacabado!='', function ($query){$query->where('acabado_id',$this->filtroacabado);})
            ->when($this->filtrofamilia!='', function ($query){$query->where('familia_id',$this->filtrofamilia);})
            ->orderBy('producto_tipos.nombre')
            ->get();

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
            ->orderBy('referencia','asc')
            ->get();

        $stocks= StockMovimiento::query()
            ->join('productos','productos.id','stock_movimientos.producto_id')
            ->with('producto')
            ->with('producto.entidad')
            ->where('stock_movimientos.tipomovimiento','!=','R')
            ->select('stock_movimientos.*','productos.material_id','productos.referencia as referencia',)
            ->selectRaw('sum(cantidad) as balance')
            ->searchYear('fechamovimiento',$this->filtroanyo)
            ->searchMes('fechamovimiento',$this->filtromes)
            ->when($this->filtrodescripcion!='', function ($query){
                $query->where('descripcion','LIKE','%'.$this->filtrodescripcion.'%');
            })
            ->when($this->filtromaterial!='', function ($query){
                $query->where('material_id',$this->filtromaterial);
            })
            ->when($this->filtrofamilia!='', function ($query){
                $query->where('familia_id',$this->filtrofamilia);
            })
            ->when($this->filtroacabado!='', function ($query){
                $query->where('acabado_id',$this->filtroacabado);
            })
            ->when($this->filtroclipro!='', function ($query){
                $query->whereHas('producto',function($q){
                    $q->where('entidad_id',$this->filtroclipro);
                });
            })
            ->searchYear('fechamovimiento',$this->filtroanyo)
            ->searchMes('fechamovimiento',$this->filtromes)
            ->search('referencia',$this->search)
            ->orSearch('descripcion',$this->search)
            ->groupBy($this->tipo)
            ->orderBy($this->ordenacion)
            ->paginate(15);

        return view('livewire.stock-balance',compact('stocks','proveedores','productos','familias','acabados','tipos','materiales'));

    }

    public function updatingSearch(){
        $this->resetPage();
    }
    public function updatingFiltroclipro(){
        $this->resetPage();
    }
    public function updatingFiltromaterial(){
        $this->resetPage();
    }
    public function updatingFiltrofamilia(){
        $this->resetPage();
    }
    public function updatingFiltroacabado(){
        $this->resetPage();
    }
    public function updatingFiltrotipo(){
        $this->resetPage();
    }
    public function updatingFiltroanyo(){
        $this->resetPage();
    }
    public function updatingFiltromes(){
        $this->resetPage();
    }



    public function exportSelected(){
        //toCsv es una macro a n AppServiceProvider
        return response()->streamDownload(function(){
            echo $this->selectedRowsQuery->toCsv();
        },'movimientos.csv');

        $this->dispatchBrowserEvent('notify', 'CSV Movimientos descargados!');
    }


    public function exportXLS()
    {
        return Excel::download(new StockBalanceExport(
            $this->search, $this->filtroclipro, $this->filtromaterial,$this->filtrofamilia, $this->filtroacabado,  $this->search, $this->filtroanyo, $this->filtromes, $this->filtrofecha, $this->tipo
        ), 'stock.xlsx');

    }

}
