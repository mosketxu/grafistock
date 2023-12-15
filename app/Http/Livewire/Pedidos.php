<?php

namespace App\Http\Livewire;

use App\Exports\PedidodetalleExport;
use App\Models\{Pedido,Entidad, PedidoDetalle};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Exports\PedidoExport;
use Maatwebsite\Excel\Facades\Excel;



class Pedidos extends Component
{
    use WithPagination, WithBulkActions;

    public $search='';
    public $filtroanyo='';
    public $filtromes='';
    public $filtroclipro='';
    public $entidad;
    public $message;
    public $total;

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
        $this->entidad=$entidad;
    }

    public function render()
    {
        if($this->selectAll) $this->selectPageRows();
        $pedidos = $this->rows;
        $proveedores = Entidad::has('pedidos')->orderBy('entidad')->get();

        $totales= Pedido::query()
            ->join('pedido_detalles','pedido_detalles.pedido_id','=','pedidos.id')
            ->select(DB::raw('cantidad * coste as total'))
            ->when($this->filtroclipro!='', function ($query){
                $query->where('entidad_id',$this->filtroclipro);
                })
            ->searchYear('fechapedido',$this->filtroanyo)
            ->searchMes('fechapedido',$this->filtromes)
            ->search('pedidos.pedido',$this->search)
            ->get()->sum('total');

            return view('livewire.pedidos',compact('pedidos','proveedores','totales'));
    }

    public function updatingFiltroclipro(){
        $this->resetPage();
    }
    public function updatingFiltroanyo(){
        $this->resetPage();
    }
    public function updatingFiltromes(){
        $this->resetPage();
    }

    public function getRowsQueryProperty(){
        return Pedido::query()
            ->join('entidades','pedidos.entidad_id','=','entidades.id')
            ->select('pedidos.*', 'entidades.entidad', 'entidades.nif','entidades.emailadm')
            ->when($this->entidad->id!='', function ($query){
                $query->where('entidad_id',$this->entidad->id);
                })
            ->when($this->filtroclipro!='', function ($query){
                $query->where('entidad_id',$this->filtroclipro);
                })
            ->searchYear('fechapedido',$this->filtroanyo)
            ->searchMes('fechapedido',$this->filtromes)
            ->search('entidades.entidad',$this->search)
            ->orSearch('pedidos.pedido',$this->search)
            ->orderBy('pedidos.fechapedido','desc')
            ->orderBy('pedidos.id','desc');
            // ->paginate(5); solo contemplo la query, no el resultado. Luego pongo el resultado: get, paginate o lo que quiera
    }

    public function getXlsQueryProperty(){
        return Pedido::query()
            ->join('entidades','pedidos.entidad_id','=','entidades.id')
            ->join('solicitantes','pedidos.solicitante_id','=','solicitantes.id')
            ->join('ubicaciones','pedidos.ubicacion_id','=','ubicaciones.id')
            ->select('pedidos.pedido','entidades.entidad','solicitantes.nombre as solicitante',
                'pedidos.fechapedido','pedidos.fecharecepcionprevista','pedidos.fecharecepcion',
                'ubicaciones.nombre as almacen','pedidos.estado','pedidos.observaciones','pedidos.total',
                )
            ->when($this->entidad->id!='', function ($query){
                $query->where('entidad_id',$this->entidad->id);
                })
            ->when($this->filtroclipro!='', function ($query){
                $query->where('entidad_id',$this->filtroclipro);
                })
            ->searchYear('fechapedido',$this->filtroanyo)
            ->searchMes('fechapedido',$this->filtromes)
            ->search('entidades.entidad',$this->search)
            ->orSearch('pedidos.pedido',$this->search)
            ->orderBy('pedidos.fechapedido','desc')
            ->orderBy('pedidos.id','desc');
            // ->paginate(5); solo contemplo la query, no el resultado. Luego pongo el resultado: get, paginate o lo que quiera
    }

    public function getXlsdetalleQueryProperty(){
        return Pedido::query()
            ->join('entidades','pedidos.entidad_id','=','entidades.id')
            ->join('solicitantes','pedidos.solicitante_id','=','solicitantes.id')
            ->join('ubicaciones','pedidos.ubicacion_id','=','ubicaciones.id')
            ->join('pedido_detalles','pedidos.id','=','pedido_detalles.pedido_id')
            ->join('productos','productos.id','=','pedido_detalles.producto_id')
            ->select('pedidos.pedido','entidades.entidad','solicitantes.nombre as solicitante',
                'pedidos.fechapedido','pedidos.fecharecepcionprevista','pedidos.fecharecepcion',
                'ubicaciones.nombre as almacen','pedidos.estado','pedidos.observaciones','pedidos.total',
                'productos.referencia','productos.descripcion',
                'pedido_detalles.cantidad','pedido_detalles.total',
                )
            ->when($this->entidad->id!='', function ($query){
                $query->where('entidad_id',$this->entidad->id);
                })
            ->when($this->filtroclipro!='', function ($query){
                $query->where('entidad_id',$this->filtroclipro);
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
        return $this->rowsQuery->paginate(10);
    }

    public function exportSelected(){
        //toCsv es una macro a n AppServiceProvider

        return response()->streamDownload(function(){
            echo $this->selectedRowsQuery->toCsv();
        },'pedidos.csv');

        $this->dispatchBrowserEvent('notify', 'CSV Pedidos descargado!');
    }

    public function exportPedidosSelectedXLS(){
        $seleccion=$this->selectedXlsQuery->get();
        return Excel::download(new PedidoExport(
           $seleccion
        ), 'pedidos.xlsx');
    }

    public function exportPedidosDetalladosSelectedXLS(){
        $seleccion=$this->selectedXlsdetalleQuery->get();
        return Excel::download(new PedidodetalleExport(
           $seleccion
        ), 'pedidosdetallados.xlsx');
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
