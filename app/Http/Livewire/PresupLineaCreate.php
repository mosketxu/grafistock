<?php

namespace App\Http\Livewire;

use App\Models\Presupuesto;
use App\Models\PresupuestoLinea;
use Livewire\Component;

class PresupLineaCreate extends Component
{
public $presupuesto;

public $presupuesto_id;
public $visible;
public $orden=0;
public $descripcion;
public $preciocoste='0';
public $precioventa;
public $ratio='1';
public $unidades;
public $fichero;
public $observaciones;

protected $rules = [
    'presupuesto_id'=>'required|numeric',
    'visible'=>'nullable',
    'orden'=>'nullable|numeric',
    'descripcion'=>'required',
    'preciocoste'=>'numeric',
    'precioventa'=>'numeric',
    'ratio'=>'numeric',
    'unidades'=>'numeric',
    'observaciones'=>'nullable',

];

    public function mount($presupuestoId)
    {
        $this->presupuesto=Presupuesto::find($presupuestoId);
        $this->presupuesto_id=$presupuestoId;
    }

    public function render()
    {
            return view('livewire.presup-linea-create');
    }

    public function save()
    {
        $this->validate();

        PresupuestoLinea::create([
            'presupuesto_id'=>$this->presupuesto_id,
            'visible'=>$this->visible,
            'orden'=>$this->orden,
            'descripcion'=>$this->descripcion,
            'preciocoste'=>$this->preciocoste,
            'precioventa'=>$this->precioventa,
            'ratio'=>$this->ratio,
            'unidades'=>$this->unidades,
            'observaciones'=>$this->observaciones,

        ]);

        $this->dispatchBrowserEvent('notify', 'Línea añadida con éxito');

        $this->emit('linearefresh');
        $this->visible='';
        $this->orden='';
        $this->descripcion='';
        $this->preciocoste='0';
        $this->precioventa='0';
        $this->ratio='1';
        $this->unidades='0';
        $this->observaciones='';
    }
}
