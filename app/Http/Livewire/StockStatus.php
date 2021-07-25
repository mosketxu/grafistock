<?php

namespace App\Http\Livewire;

use App\Models\{Entidad,Producto, Stock,PedidoDetalle};

use Livewire\WithPagination;
use App\Http\Livewire\DataTable\WithBulkActions;

use Livewire\Component;

class StockStatus extends Component
{

    use WithPagination, WithBulkActions;

    public $search='';
    public $filtroproveedor='';
    public $filtroproducto='';
    public $filtroanyo='';
    public $filtromes='';
    public $filtrofecha='';

    public Stock $stock;

    public function render()
    {


        if($this->selectAll) $this->selectPageRows();

        $stocks = $this->rows;

        $proveedores=Entidad::query()
        ->whereHas('pedidos')
        ->orderBy('entidad')
        ->get();

        $productos=Producto::query()
        ->whereHas('pedidodetalles')
        ->when($this->filtroproveedor!='', function ($query){
            $query->where('entidad_id',$this->filtroproveedor);
            })
        ->get();

        return view('livewire.stock-status',compact('stocks','proveedores','productos'));
    }

    public function getRowsQueryProperty(){
        return Stock::query()
            ->with('producto')
            ->when($this->filtroproducto!='', function ($query){
                $query->where('producto_id',$this->filtroproducto);
                })
            ->when($this->filtroproveedor!='', function ($query){
                $query->whereHas('producto.entidad',function($q){
                    $q->where('entidad_id',$this->filtroproveedor);
                    });
                })
            ->searchYear('fechamovimiento',$this->filtroanyo)
            ->searchMes('fechamovimiento',$this->filtromes)
            ->orderBy('stocks.fechamovimiento','desc');
            // ->paginate(5); solo contemplo la query, no el resultado. Luego pongo el resultado: get, paginate o lo que quiera
    }

    public function getRowsProperty(){
        return $this->rowsQuery->groupBy('producto_id')->selectRaw('producto_id,sum(cantidad) as total')->paginate();
    }

    public function exportSelected(){
        //toCsv es una macro a n AppServiceProvider
        return response()->streamDownload(function(){
            echo $this->selectedRowsQuery->toCsv();
        },'movimientos.csv');

        $this->dispatchBrowserEvent('notify', 'CSV Movimientos descargados!');
    }

    public function deleteSelected(){
        $deleteCount = $this->selectedRowsQuery->count();
        $this->selectedRowsQuery->delete();
        $this->showDeleteModal = false;

        $this->dispatchBrowserEvent('notify', $deleteCount . ' Movimientos eliminados!');
    }

    public function delete($stockId)
    {
        $sotck = Stock::find($stockId);
        if ($stock) {
            $stock->delete();
            // session()->flash('message', $stock->entidad.' eliminado!');
            $this->dispatchBrowserEvent('notify', 'La línea de stock: '.$stock->id.' ha sido eliminada!');
        }
    }

}
