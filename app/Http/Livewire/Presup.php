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
    public $preciocoste;
    public $descripcion;
    public $observaciones;

    protected $listeners = [ 'presupuestorefresh' => 'presupuestorefresh'];

    protected function rules(){
        return [

            'precioventa'=>'nullable|numeric',
            'preciocoste'=>'nullable|numeric',
            'unidades'=>'nullable|numeric',
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
        $this->observaciones=$presupuesto->observaciones;
    }

    public function render()
    {
        // dd($this->presupuesto);
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
