<?php

namespace App\Http\Livewire;

use App\Models\{PedidoDetalle, Producto, ProductoMaterial, ProductoUnidadcoste};
use Livewire\Component;
use phpDocumentor\Reflection\Types\Nullable;

class PedidoDetalleCreate extends Component
{
    public $pedido;
    public $detalle;
    public $message;
    public $udcompra_id;
    public $material='';
    public $productos;
    public $descripcion='';

    protected $rules = [
        'pedido.id' => 'required',
        'detalle.pedido_id'=>'numeric|required',
        'detalle.producto_id'=>'numeric|required',
        'detalle.orden'=>'numeric',
        'detalle.cantidad'=>'numeric|required',
        'detalle.coste'=>'numeric|required',
        'detalle.udcompra_id'=>'nullable',
        'detalle.iva'=>'numeric|required',
    ];

    protected $listeners = [ 'showNuevoDetalle'=>'funshowdetalle', 'detallerefresh' => '$refresh'];

    public function mount(PedidoDetalle $detalle)
    {
        $this->detalle=$detalle;
        $this->detalle->pedido_id=$this->pedido->id;
        $this->detalle->orden=0;
        $this->detalle->cantidad=0;
        $this->detalle->udcompra_id='';
        $this->detalle->coste=0;
        $this->detalle->iva=0;

    }

    public function render()
    {
        $this->productos=Producto::query()
        ->where('entidad_id',$this->detalle->pedido->entidad_id)
        ->when($this->material!='', function ($query){
            $query->where('material_id',$this->material);
            })
        ->orderBy('referencia')
        ->get();

        $mat=Producto::select('material_id')->where('entidad_id',$this->detalle->pedido->entidad_id)
            ->groupBy('material_id')
            ->get()->toArray();
        $materiales=ProductoMaterial::whereIn('sigla',$mat)->orderBy('nombre')->get();

        $unidadescoste=ProductoUnidadcoste::orderBy('nombre')->get();

        return view('livewire.pedido-detalle-create',compact('unidadescoste','materiales'));
    }

    public function updatedDetalleProductoId()
    {
        $p=Producto::find($this->detalle->producto_id);
        if($p){
            $this->detalle->coste=$p->costegrafitex;
            $this->detalle->udcompra_id=$p->udsolicitud_id;
            $this->descripcion=$p->descripcion;
        }else{
            $this->detalle->coste=0;
            $this->detalle->udcompra_id='';
            $this->descripcion='';
        }
    }

    public function updatedMaterial(){
        $this->detalle->producto_id='';
        $this->detalle->udcompra_id=0;
        $this->detalle->udcompra_id='';
        $this->descripcion='';
    }

    public function save()
    {
        $this->validate();
        // dd($this->detalle);
        PedidoDetalle::create([
            'pedido_id'=>$this->detalle->pedido_id,
            'orden'=>$this->detalle->orden,
            'producto_id'=>$this->detalle->producto_id,
            'cantidad'=>$this->detalle->cantidad,
            'coste'=>$this->detalle->coste,
            'udcompra_id'=>$this->detalle->udcompra_id,
            'iva'=>$this->detalle->iva,
            ]);
            $this->dispatchBrowserEvent('notify', 'Detalle añadido con éxito');

        $this->emit('detallerefresh');
        $this->detalle->pedido_id=$this->pedido->id;
        $this->detalle->orden=0;
        $this->detalle->producto_id='';
        $this->detalle->udcompra_id='';
        $this->detalle->cantidad=1;
        $this->detalle->coste=0;
        $this->descripcion='';
        $this->material='';
        $this->cantidad=0;
    }
}
