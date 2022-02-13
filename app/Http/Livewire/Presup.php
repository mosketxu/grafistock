<?php

namespace App\Http\Livewire;

use App\Models\Presupuesto;
use App\Models\PresupuestoControlpartida;
use Livewire\Component;

class Presup extends Component
{
    public $presupuesto;
    public $estado;
    public $unidades;
    public $incremento;
    public $precioventa;
    public $preciocoste;
    public $descripcion;
    public $observaciones;
    public $mesagge;

    protected $listeners = [ 'presupuestorefresh' => 'presupuestorefresh'];

    protected function rules(){
        return [
            'precioventa'=>'nullable|numeric',
            'preciocoste'=>'nullable|numeric',
            'unidades'=>'nullable|numeric',
            'incremento'=>'required|numeric',
            'descripcion'=>'required',
            'observaciones'=>'nullable',
        ];
    }

    public function presupuestorefresh()
    {
        $this->precioventa=$this->presupuesto->precioventa;
        $this->preciocoste=$this->presupuesto->preciocoste;
    }

    public function mount(Presupuesto $presupuesto)
    {
        $this->presupuesto=$presupuesto;
        $this->descripcion=$presupuesto->descripcion;
        $this->estado=$presupuesto->estado;
        $this->precioventa=$presupuesto->precioventa;
        $this->preciocoste=$presupuesto->preciocoste;
        $this->unidades=$presupuesto->unidades;
        $this->incremento=$presupuesto->incremento;
        $this->observaciones=$presupuesto->observaciones;
    }

    public function render()
    {
        $controlpartidas=PresupuestoControlpartida::where('presupuesto_id',$this->presupuesto->id)->get();
        return view('livewire.presup',compact(['controlpartidas']));
    }

    public function save()
    {
        $this->validate();

        $mensaje="Presupuesto actualizado satisfactoriamente";

        $presup=Presupuesto::findOrFail($this->presupuesto->id)
            ->update([
                'precioventa'=>$this->precioventa,
                'unidades'=>$this->unidades,
                'incremento'=>$this->incremento,
                'estado'=>$this->estado,
                'descripcion'=>$this->descripcion,
                'observaciones'=>$this->observaciones
        ]);

        $presup=Presupuesto::find($this->presupuesto->id);
        $presup->recalculo();

        $this->emit('presupuestorefresh');

        $this->dispatchBrowserEvent('notify', $mensaje);
    }

}
