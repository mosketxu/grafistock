<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Solicitante, StockPeticion as ModelStockPeticion};



class StockPeticion extends Component
{

    public $stockpeticion;

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'stockpeticion.id'=>'nullable',
            'stockpeticion.solicitante_id'=>'required',
            'stockpeticion.peticion'=>'required',
            'stockpeticion.fechasolicitud'=>'date|required',
            'stockpeticion.fecharealizado'=>'nullable|date',
            'stockpeticion.estado'=>'integer',
            'stockpeticion.observaciones'=>'nullable',
        ];
    }

    public function mount(ModelStockPeticion $stockpeticion)
    {
        $this->stockpeticion=$stockpeticion;
    }

    public function render()
    {
        $solicitantes=Solicitante::orderBy('nombre')->get();
        return view('livewire.stock-peticion',compact('solicitantes'));
    }

    public function save()
    {
        if($this->stockpeticion->estado==null)  $this->stockpeticion->estado='0'  ;
        $this->validate();
        if($this->stockpeticion->id){
            $i=$this->stockpeticion->id;
            $mensaje="Actualizado satisfactoriamente";
        }else{
            $mensaje="Creado satisfactoriamente";
        }

        $pet=ModelStockPeticion::updateOrCreate([
            'id'=>$this->stockpeticion->id
            ],
            [
            'solicitante_id'=>$this->stockpeticion->solicitante_id,
            'peticion'=>$this->stockpeticion->peticion,
            'fechasolicitud'=>$this->stockpeticion->fechasolicitud,
            'fecharealizado'=>$this->stockpeticion->fecharealizado,
            'estado'=>$this->stockpeticion->estado,
            'observaciones'=>$this->stockpeticion->observaciones,
            ]
        );
        $notification = array(
            'message' => 'Peticion creada/actualizada satisfactoriamente!',
            'alert-type' => 'success'
        );
    }

    public function borrafecharealizado(){
        if($this->stockpeticion->id){
        $p=ModelStockPeticion::find($this->stockpeticion->id);
        $p->fecharealizado=null;
        $p->save();
        return redirect(route('stockpeticion.edit',$this->stockpeticion));
        // $this->emit('refresh');
        }

    }

}
