<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
use App\Models\Pedido as ModelsPedido;
use Illuminate\Support\Facades\Response;
use Livewire\Component;


class Pedido extends Component
{

    public $pedido;
    public $message;
    public $showgenerar;
    public $pedidohecho=false;

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
        $this->showgenerar = $pedido->pedido ? true : false;
        $this->pedidohecho= $pedido->pedido ?  true : false;

    }

    public function render()
    {
        if ($this->pedido->id) {
            $this->showgenerar=true;
            if ($this->pedido->pedido) {
                $this->showgenerar=false;
            }
        }

        $entidades=Entidad::orderBy('entidad')->get();
        return view('livewire.pedido',compact('entidades'));
    }

    public function updatedPedidohecho(){
        if($this->pedidohecho){
            $this->message="Debes pulsar Generar para aplicar los cambios al pedido";
            $this->pedidohecho=false;
        }else{
            $f=ModelsPedido::find($this->pedido->id);
            $p->pedidohecho=false;
            $p->save();
            $this->redirect( route('pedido.edit',$p) );
        }
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

        $this->redirect( route('pedido.edit',$ped) );
        $this->emitSelf('notify-saved');

    }

    public function creaPedido(ModelsPedido $pedido)
    {
        $this->validate([
            'pedido.entidad_id'=>'required',
            'pedido.fechapedido'=>'required|date',
        ]);

        $anyo= substr($pedido->fechapedido->format('Y'), -4);
        $anyo2= substr($pedido->fechapedido->format('Y'), -2);


        if (!$pedido->pedido){
            $ped=ModelsPedido::whereYear('fechapedido', $anyo)->max('pedido') ;
            $ped= $ped ? $ped + 1 : ($anyo2 * 100000 +1) ;
        }else{
            $ped=$pedido->pedido;
        }

        $pedido->ruta='pedidos/'.$pedido->fechapedido->format('Y').'/'.$pedido->fechapedido->format('m');
        $pedido->fichero=trim($ped.'.pdf');

        $pedido->pedido=$ped;
        $pedido->save();

        // genero el pedido y la guardo en su carpeta de storage
        $pedido->imprimirpedido();

        // $this->nf=$pedido->serie.'-'.substr($fac,-5);
        $this->dispatchBrowserEvent('notify', 'Pedido creado!');
        $this->redirect( route('pedido.edit',$pedido) );
        // $this->emit('pedidoupdate');
    }

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
