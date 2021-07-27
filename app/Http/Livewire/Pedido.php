<?php

namespace App\Http\Livewire;

use App\Models\{Entidad, ProductoMaterial};
use App\Models\Pedido as ModelsPedido;
use Illuminate\Support\Facades\Response;
use Livewire\Component;
use Illuminate\Validation\Rule;


class Pedido extends Component
{

    public $pedido;
    public $message;
    public $showgenerar;
    public $showcrear='';
    public $realizado;

    protected $listeners = [
        'pedidoupdate' => '$refresh',
    ];

    protected function rules(){
        return [
            'pedido.id'=>'nullable',
            'pedido.pedido'=>'nullable|max:7',
            'pedido.entidad_id'=>'required',
            'pedido.fechapedido'=>'date|required',
            'pedido.fecharecepcionprevista'=>'date|nullable',
            'pedido.fecharecepcion'=>'date|nullable',
            'pedido.ruta'=>'nullable',
            'pedido.fichero'=>'nullable',
            'pedido.observaciones'=>'nullable',
            'pedido.finalizado'=>'boolean',
            'pedido.bloqueado'=>'boolean',
        ];
    }

    public function mount(ModelsPedido $pedido)
    {
        $this->pedido=$pedido;
        if(!$this->pedido->id) $this->pedido->entidad_id='';
    }

    public function render()
    {
        $this->showcrear = $this->pedido->pedido ? true : false;
        $entidades=Entidad::orderBy('entidad')->get();
        $materiales=ProductoMaterial::orderBy('nombre')->get();
        return view('livewire.pedido',compact('entidades','materiales'));
    }

    public function UpdatedPedidoPedido()
    {
        $this->validate([
            'pedido.pedido'=>['required',Rule::unique('pedidos','pedido')->ignore($this->pedido->id)]
        ]);
        $this->save();
    }

    public function numpedido()
    {
        $anyo= substr($this->pedido->fechapedido->format('Y'), -4);
        $anyo2= substr($this->pedido->fechapedido->format('Y'), -2);

        if (!$this->pedido->pedido){
            $ped=ModelsPedido::whereYear('fechapedido', $anyo)->max('pedido') ;
            $this->pedido->pedido= $ped ? $ped + 1 : ($anyo2 * 100000 +1) ;
        }
    }

    public function save()
    {
        $this->validate();

        $this->message='';

        if ($this->pedido->id) {
            $i=$this->pedido->id;
            $this->validate([
                'pedido.pedido'=>['required',Rule::unique('pedidos','pedido')->ignore($this->pedido->id)]
            ]);

            $mensaje="Pedido actualizado satisfactoriamente";
        } else {
            $this->numpedido();
            $i=$this->pedido->id;
            $mensaje="Pedido creado satisfactoriamente";
        }

        $pedido=ModelsPedido::updateOrCreate(
            [
            'id'=>$this->pedido->id
            ],
            [
                'pedido'=>$this->pedido->pedido,
                'entidad_id'=>$this->pedido->entidad_id,
                'fechapedido'=>$this->pedido->fechapedido,
                'fecharecepcionprevista'=>$this->pedido->fecharecepcionprevista,
                'fecharecepcion'=>$this->pedido->fecharecepcion,
                'metodopago_id'=>$this->pedido->metodopago_id,
                'ruta'=>$this->pedido->ruta,
                'fichero'=>$this->pedido->fichero,
                'observaciones'=>$this->pedido->observaciones,
                'bloqueado'=>$this->pedido->bloqueado,
            ]
        );

        $this->pedido->id=$pedido->id;
        $this->showcrear=1;
        $this->emit('pedidoupdate');
        // $this->emit('detallerefresh');
        // $this->emit('showNuevoDetalle');
        $this->dispatchBrowserEvent('notify', $mensaje);

            // $this->redirect(route('pedido.edit', $ped));
            // $this->emitSelf('notify-saved');
    }

    // public function creaPedido(ModelsPedido $pedido)
    // {
    //     $this->validate([
    //         'pedido.entidad_id'=>'required',
    //         'pedido.fechapedido'=>'required|date',
    //     ]);

    //     $anyo= substr($pedido->fechapedido->format('Y'), -4);
    //     $anyo2= substr($pedido->fechapedido->format('Y'), -2);


    //     if (!$pedido->pedido){
    //         $ped=ModelsPedido::whereYear('fechapedido', $anyo)->max('pedido') ;
    //         $ped= $ped ? $ped + 1 : ($anyo2 * 100000 +1) ;
    //     }else{
    //         $ped=$pedido->pedido;
    //     }

    //     $pedido->bloqueado=true;
    //     $pedido->pedido=$ped;
    //     $pedido->save();

        // genero el pedido y la guardo en su carpeta de storage
        // $pedido->ruta='pedidos/'.$pedido->fechapedido->format('Y').'/'.$pedido->fechapedido->format('m');
        // $pedido->fichero=trim($ped.'.pdf');
        // $pedido->imprimirpedido();

        // actualizo las vbles del componente para que se refresque bien
    //     $this->pedido->bloqueado=true;
    //     $this->pedido->pedido=$pedido->pedido;

    //     $this->emit('pedidoupdate');
    //     $this->emit('detallerefresh');

    //     $this->dispatchBrowserEvent('notify', 'Pedido creado!');
    // }

    public function presentaPDF(Pedido $pedido){

        return Response::download('storage/'.$this->pedido->rutafichero);
    }

    public function delete($pedidoId)
    {
        $pedidoBorrar = ModelsPedido::find($pedidoId);

        if ($pedidoBorrar) {
            $pedidoBorrar->delete();
            $this->dispatchBrowserEvent('notify', 'Pedido eliminado!');
        }
    }
}
