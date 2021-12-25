<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Models\{StockMovimiento,Entidad,ProductoMaterial,Producto, Solicitante,ProductoAcabado, ProductoFamilia};
use Livewire\Component;
use App\Exports\StockBalanceExport;
use Maatwebsite\Excel\Facades\Excel;

// use Illuminate\Support\Facades\DB;

class StockBalance extends Component
{
    use WithPagination, WithBulkActions;

    public $search='';
    public $filtroclipro='';
    public $filtromaterial='';
    public $filtrofamilia='';
    public $filtroacabado='';
    public $filtroproducto='';
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
        $stocks = $this->rows;

        $proveedores=Entidad::query()
            ->whereHas('pedidos')
            ->orderBy('entidad')
            ->get();
        $familias=ProductoFamilia::orderBy('nombre')->get();
        $materiales=ProductoMaterial::orderBy('nombre')->get();
        $solicitantes=Solicitante::orderBy('nombre')->get();
        $acabados=ProductoAcabado::orderBy('nombre')->get();

        $productos=Producto::orderBy('referencia')
            ->when($this->filtroclipro!='', function ($query){
                $query->where('entidad_id',$this->filtroclipro);
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
            ->search('descripcion',$this->filtrodescripcion)
            ->get();

        return view('livewire.stock-balance',compact('stocks','proveedores','familias','materiales','acabados','solicitantes'));
    }

    public function updatingFiltroclipro(){
        $this->resetPage();
    }
    public function updatingFiltroproducto(){
        $this->resetPage();
    }
    public function updatingFiltromaterial(){
        $this->resetPage();
    }
    public function updatingFiltrosolicitante(){
        $this->resetPage();
    }
    public function updatingFiltroacabado(){
        $this->resetPage();
    }
    public function updatingFiltroanyo(){
        $this->resetPage();
    }
    public function updatingFiltromes(){
        $this->resetPage();
    }
    public function updatingDescripcion(){
        $this->resetPage();
    }


    public function getRowsQueryProperty(){
        return StockMovimiento::query()
            ->join('productos','productos.id','stock_movimientos.producto_id')
            ->with('producto')
            ->with('producto.entidad')
            ->where('stock_movimientos.tipomovimiento','!=','R')
            ->select('stock_movimientos.*','productos.material_id','productos.referencia as referencia',)
            ->selectRaw('sum(cantidad) as balance')
            ->searchYear('fechamovimiento',$this->filtroanyo)
            ->searchMes('fechamovimiento',$this->filtromes)
            ->when($this->filtroproducto!='', function ($query){
                $query->where('producto_id',$this->filtroproducto);
            })
            ->when($this->filtrosolicitante!='', function ($query){
                $query->where('solicitante_id',$this->filtrosolicitante);
            })
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
            ->groupBy($this->tipo)
            ->orderBy($this->ordenacion);
        // ->paginate(5); solo contemplo la query, no el resultado. Luego pongo el resultado: get, paginate o lo que quiera

    }

    public function getRowsProperty(){
        return $this->rowsQuery->paginate();
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
            $this->search, $this->filtroclipro, $this->filtromaterial,$this->filtrofamilia, $this->filtroacabado, $this->filtroproducto, $this->filtrodescripcion, $this->filtrosolicitante, $this->filtroanyo, $this->filtromes, $this->filtrofecha, $this->tipo
        ), 'stock.xlsx');

    }

}
