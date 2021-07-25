<?php

namespace App\Http\Livewire;

use App\Models\{Pedido,Entidad};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\DataTable\WithBulkActions;


class Pedidos extends Component
{
    use WithPagination, WithBulkActions;

    public $search='';
    public $filtroanyo='';
    public $filtromes='';
    public $filtroproveedor='';
    public $entidad;
    public $message;

    public $showDeleteModal=false;

    protected function rules(){
        return[
            'filtroanyo'=>'required',
            'filtromes'=>'required',
        ];
    }

    public function mount(Entidad $entidad)
    {
        $this->filtroanyo=date('Y');
        // $this->filtromes=intval(date('m'));
        $this->entidad=$entidad;
    }

    public function render()
    {
        if($this->selectAll) $this->selectPageRows();
        $pedidos = $this->rows;
        $proveedores = Entidad::orderBy('entidad')->get();

        $totales= Pedido::query()
        ->join('entidades','pedidos.entidad_id','=','entidades.id')
        ->join('pedido_detalles','pedidos.id','=','pedido_detalles.pedido_id')
        ->select('pedidos.*', 'entidades.entidad', 'entidades.nif','entidades.emailadm',DB::raw('sum(cantidad * coste) as totalbase'),DB::raw('sum(cantidad * coste * iva) as totaliva'),DB::raw('sum(cantidad * coste * (1+ iva)) as totales'))
        ->searchYear('fechapedido',$this->filtroanyo)
        ->searchMes('fechapedido',$this->filtromes)
        ->search('pedidos.pedido',$this->search)
        ->orSearch('entidades.entidad',$this->search)
        ->first();
        return view('livewire.pedidos',compact('pedidos','proveedores','totales'));
    }

    public function getRowsQueryProperty(){
        return Pedido::query()
            ->join('entidades','pedidos.entidad_id','=','entidades.id')
            ->select('pedidos.*', 'entidades.entidad', 'entidades.nif','entidades.emailadm')
            ->when($this->entidad->id!='', function ($query){
                $query->where('entidad_id',$this->entidad->id);
                })
            ->when($this->filtroproveedor!='', function ($query){
                $query->where('entidad_id',$this->filtroproveedor);
                })
            ->searchYear('fechapedido',$this->filtroanyo)
            ->searchMes('fechapedido',$this->filtromes)
            ->search('entidades.entidad',$this->search)
            ->orSearch('pedidos.pedido',$this->search)
            ->orderBy('pedidos.fechapedido','desc')
            ->orderBy('pedidos.id','desc');
            // ->paginate(5); solo contemplo la query, no el resultado. Luego pongo el resultado: get, paginate o lo que quiera
    }

    public function getRowsProperty(){
        return $this->rowsQuery->paginate();
    }

    public function exportSelected(){
        //toCsv es una macro a n AppServiceProvider
        return response()->streamDownload(function(){
            echo $this->selectedRowsQuery->toCsv();
        },'pedidos.csv');

        $this->dispatchBrowserEvent('notify', 'CSV Pedidos descargado!');
    }

    public function deleteSelected(){
        $deleteCount = $this->selectedRowsQuery->count();
        $this->selectedRowsQuery->delete();
        $this->showDeleteModal = false;

        $this->dispatchBrowserEvent('notify', $deleteCount . ' Pedidos eliminados!');
    }

    public function delete($pedidoId)
    {
        $pedido = Pedido::find($pedidoId);
        if ($pedido) {
            $pedido->delete();
            // session()->flash('message', $pedido->entidad.' eliminado!');
            $this->dispatchBrowserEvent('notify', 'La línea de pedido: '.$pedido->id.'-'.$pedido->pedido.' ha sido eliminada!');
        }
    }


}
