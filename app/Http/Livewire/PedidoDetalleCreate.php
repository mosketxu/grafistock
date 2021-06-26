<?php

namespace App\Http\Livewire;

use App\Models\{DetallePedido, Producto, ProductoUnidadcoste};
use Livewire\Component;
use phpDocumentor\Reflection\Types\Nullable;

class PedidoDetalleCreate extends Component
{
    public $pedido;
    public $detalle;
    public $message;
    public $udcompra;

    protected $rules = [
        'pedido.id' => 'required',
        'detalle.pedido_id'=>'numeric|required',
        'detalle.producto_id'=>'numeric|required',
        'detalle.orden'=>'numeric',
        'detalle.cantidad'=>'numeric|required',
        'detalle.coste'=>'numeric|required',
        'detalle.iva'=>'numeric|required',
        'udcompra'=>'nullable',
    ];

    protected $listeners = [ 'funshowc'=>'funshowdetallec', 'detallerefreshc' => '$refresh'];

    public function mount(DetallePedido $detalle)
    {
        $this->detalle=$detalle;
        $this->detalle->pedido_id=$this->pedido->id;
        $this->detalle->orden=0;
        $this->detalle->cantidad=0;
        $this->detalle->udcompra='';
        $this->detalle->coste=0;
        $this->detalle->iva=0;

    }

    public function render()
    {
        $productos=Producto::where('entidad_id',$this->detalle->pedido->entidad_id)->orderBy('referencia')->get();
        $unidades=ProductoUnidadcoste::get();
        return view('livewire.pedido-detalle-create',compact('productos','unidades'));
    }

    public function updatedDetalleProductoId()
    {
        $p=Producto::find($this->detalle->producto_id);

        $this->detalle->coste=$p->costegrafitex;
        $this->udcompra=$p->udsolicitud_id;
        // dd($this->udcompra);
    }

    public function save()
    {
        // dd($this->udcompra);
        if($this->detalle){
            $this->validate();
            DetallePedido::create([
                'pedido_id'=>$this->detalle->pedido_id,
                'orden'=>$this->detalle->orden,
                'producto_id'=>$this->detalle->producto_id,
                'cantidad'=>$this->detalle->cantidad,
                'coste'=>$this->detalle->coste,
                'udcompra'=>$this->udcompra,
                'iva'=>$this->detalle->iva,
                ]);
                $this->dispatchBrowserEvent('notify', 'Detalle añadido con éxito');

            $this->emit('detallerefresh');
            $this->detalle->pedido_id=$this->pedido->id;
            $this->detalle->orden=0;
            $this->detalle->producto_id='';
            $this->detalle->udcompra='';
            $this->detalle->cantidad=1;
            $this->detalle->coste=0;

        }
    }
}
