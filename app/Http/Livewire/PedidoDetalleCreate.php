<?php

namespace App\Http\Livewire;

use App\Models\{PedidoDetalle, Producto, ProductoMaterial, ProductoUnidadcoste,Pedido};
use Livewire\Component;
use phpDocumentor\Reflection\Types\Nullable;

class PedidoDetalleCreate extends Component
{
    public $entidadId;
    public $pedido;
    public $pedidoId;
    public $detalle;
    public $orden=0;
    public $cantidad=0;
    public $udcompraId='';
    public $productoId='';
    public $coste=0;

    public $message;

    public $material='';
    public $productos;
    public $descripcion='';

    protected $rules = [
        'pedidoId'=>'numeric|required',
        'productoId'=>'numeric|required',
        'orden'=>'numeric',
        'cantidad'=>'numeric|required',
        'coste'=>'numeric|required',
        'udcompraId'=>'required',
    ];


    public function mount($pedidoId)
    {
        $this->pedido=Pedido::find($pedidoId);
        $this->entidadId=$this->pedido->entidad_id;
        $this->pedidoId=$pedidoId;
    }

    public function render()
    {
        $this->productos=Producto::query()
        ->where('entidad_id',$this->entidadId)
        ->when($this->material!='', function ($query){
            $query->where('material_id',$this->material);
            })
        ->orderBy('referencia')
        ->get();

        $mat=Producto::select('material_id')->where('entidad_id',$this->entidadId)
            ->groupBy('material_id')
            ->get()->toArray();
        $materiales=ProductoMaterial::whereIn('id',$mat)->orderBy('nombre')->get();

        $unidadescoste=ProductoUnidadcoste::orderBy('nombre')->get();

        return view('livewire.pedido-detalle-create',compact('unidadescoste','materiales'));
    }

    public function updatedProductoId()
    {
        $p=Producto::find($this->productoId);
        if($p){
            $this->coste=$p->preciotarifa;
            $this->udcompraId=$p->udsolicitud_id;
            $this->descripcion=$p->descripcion;
        }else{
            $this->coste=0;
            $this->udcompraId='';
            $this->descripcion='';
        }
    }

    public function updatedMaterial(){
        $this->productoId='';
        $this->udcompraId=0;
        $this->udcompraId='';
        $this->descripcion='';
    }

    public function save()
    {
        $this->validate();

        PedidoDetalle::create([
            'pedido_id'=>$this->pedidoId,
            'orden'=>$this->orden,
            'producto_id'=>$this->productoId,
            'cantidad'=>$this->cantidad,
            'coste'=>$this->coste,
            'udcompra_id'=>$this->udcompraId
        ]);

        $this->dispatchBrowserEvent('notify', 'Detalle añadido con éxito');

        $this->emit('detallerefresh');
        $this->pedidoId=$this->pedido->id;
        $this->orden=0;
        $this->productoId='';
        $this->udcompraId='';
        $this->cantidad=1;
        $this->coste=0;
        $this->descripcion='';
        $this->material='';
        $this->cantidad=0;
    }
}
