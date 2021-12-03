<?php

namespace App\Http\Livewire;

use App\Models\Presupuesto;
use Livewire\Component;

class Presup extends Component
{
    public $presupuesto;
    public $estado;
    public $unidades;
    public $precioventa;
    public $preciotarifa;
    public $descripcion;
    public $observaciones;
    public $mesagge;

    protected $listeners = [ 'presupuestorefresh' => 'presupuestorefresh'];

    protected function rules(){
        return [

            'precioventa'=>'nullable|numeric',
            'preciotarifa'=>'nullable|numeric',
            'unidades'=>'nullable|numeric',
            'descripcion'=>'required',
            'observaciones'=>'nullable',
        ];
    }

    public function presupuestorefresh()
    {
        $this->precioventa=$this->presupuesto->precioventa;
        $this->preciotarifa=$this->presupuesto->preciotarifa;
    }

    public function mount(Presupuesto $presupuesto)
    {
        $this->presupuesto=$presupuesto;
        $this->descripcion=$presupuesto->descripcion;
        $this->estado=$presupuesto->estado;
        $this->precioventa=$presupuesto->precioventa;
        $this->preciotarifa=$presupuesto->preciotarifa;
        $this->unidades=$presupuesto->unidades;
        $this->observaciones=$presupuesto->observaciones;
    }

    public function render()
    {
        return view('livewire.presup');
    }

    public function save()
    {
        $this->validate();

        $mensaje="Presupuesto actualizado satisfactoriamente";

        $pres=Presupuesto::find($this->presupuesto->id);
        Presupuesto::findOrFail($this->presupuesto->id)
            ->update([
                'precioventa'=>$this->precioventa,
                'unidades'=>$this->unidades,
                'estado'=>$this->estado,
                'descripcion'=>$this->descripcion,
                'observaciones'=>$this->observaciones
        ]);

        $this->dispatchBrowserEvent('notify', $mensaje);
    }

}
