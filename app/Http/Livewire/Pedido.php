<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
use App\Models\Pedido as ModelsPedido;
use Livewire\Component;


class Pedido extends Component
{

    public $pedido;
    public $mostrarGenerar=0;
    public $message;
    public $showgenerar;

    protected $listeners = [
        'pedidoupdate' => '$refresh',
    ];

    protected function rules(){
        return [
            'pedido.id'=>'nullable',
            'pedido.pedido'=>'nullable',
            'pedido.entidad_id'=>'required',
            'pedido.fechapedido'=>'date|required',
            'pedido.fecharecepcionprevista'=>'date|nullable',
            'pedido.fecharecepcion'=>'date|nullable',
            'pedido.ruta'=>'nullable',
            'pedido.fichero'=>'nullable',
            'pedido.observaciones'=>'nullable',
        ];
    }

    public function mount(ModelsPedido $pedido)
    {
        $this->pedido=$pedido;

    }

    public function render()
    {
        $entidades=Entidad::orderBy('entidad')->get();
        return view('livewire.pedido',compact('entidades'));
    }

    public function save()
    {
        $this->validate();

        $this->message='';
        if ($this->pedido->id) {
            $i=$this->pedido->id;
            $mensaje="Pedido actualizado satisfactoriamente";
        } else {
            $i=$this->pedido->id;
            $mensaje="Pedido creado satisfactoriamente";
        }

        if (!$this->pedido->pedido) $this->pedido->pedido=$this->pedido->id .' logica a aplicar' ;

        $ped=ModelsPedido::updateOrCreate([
            'id'=>$i
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
            ]
        );
        $this->emitSelf('notify-saved');
    }

    public function creaPedido(ModelsPedido $pedido)
    {
        $this->validate([
            'pedido.entidad_id'=>'required|numeric',
            'pedido.entidad_id'=>'required|numeric',
        ]);

        if (!$pedido->pedido){
            $ped=$pedido->id .' logica a aplicar' ;
        }else{
            $fac=$pedido->pedido;
        }

        $pedido->ruta='pedidos/'.$pedido->fechapedido->format('Y').'/'.$pedido->fechapedido->format('m');
        $pedido->fichero=trim($pedido->pedido.'pdf');

        $pedido->pedido=$fac;
        $pedido->save();
        // genero la pedido y la guardo en su carpeta de storage
        // $pedido->imprimirpedido();
        // $this->nf=$pedido->serie.'-'.substr($fac,-5);
        $this->dispatchBrowserEvent('notify', 'Pedido creado!');
        $this->redirect( route('pedido.edit',$pedido) );
        // $this->emit('pedidoupdate');
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
