<?php

namespace App\Http\Livewire;

use App\Models\{Entidad, ProductoMaterial, Solicitante};
use App\Models\Pedido as ModelsPedido;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Validation\Rule;


class Pedido extends Component
{

    public $pedido;
    public $message;
    public $showgenerar;
    public $showcrear='';
    public $realizado;
    public $nuevo='No';

    protected $listeners = [
        'pedidoupdate' => '$refresh',
    ];

    protected function rules(){
        return [
            'pedido.id'=>'nullable',
            'pedido.pedido'=>'nullable|max:7',
            'pedido.solicitante_id'=>'required',
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
        if(!$this->pedido->id) $this->pedido->entidad_id='';
    }

    public function render()
    {
        $this->showcrear = $this->pedido->pedido ? true : false;
        $entidades=Entidad::select('id','entidad')->orderBy('entidad')->get();
        $materiales=ProductoMaterial::orderBy('nombre')->get();
        $solicitantes=Solicitante::orderBy('nombre')->get();
        return view('livewire.pedido',compact('entidades','materiales','solicitantes'));
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
            $this->nuevo="No";
            $i=$this->pedido->id;
            $this->validate([
                'pedido.pedido'=>['required',Rule::unique('pedidos','pedido')->ignore($this->pedido->id)]
            ]);

            $mensaje="Pedido actualizado satisfactoriamente";
        } else {
            $this->nuevo="Sí";
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
                'solicitante_id'=>$this->pedido->solicitante_id,
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

        $this->pedido->id=$pedido->id;
        $this->showcrear=1;
        $this->emit('pedidoupdate');

        if ($this->nuevo=='Sí') {
            // Session::flash('message', $mensaje);
            $this->nuevo='No';
            return redirect(route('pedido.edit', $pedido));

        }
        $this->dispatchBrowserEvent('notify', $mensaje);
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
