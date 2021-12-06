<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
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
public $preciotarifa='0';
public $precioventa='0';
public $unidades='0';
public $fichero;
public $observaciones;

protected $rules = [
    'presupuesto_id'=>'required|numeric',
    'visible'=>'nullable',
    'orden'=>'nullable|numeric',
    'descripcion'=>'required',
    'preciotarifa'=>'numeric',
    'precioventa'=>'numeric',
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
            'preciotarifa'=>$this->preciotarifa,
            'precioventa'=>$this->precioventa,
            'unidades'=>$this->unidades,
            'observaciones'=>$this->observaciones,
        ]);

        $presupuesto=Presupuesto::find($this->presupuesto->id);
        return redirect()->route('presupuesto.edit',$presupuesto);

        // $this->dispatchBrowserEvent('notify', 'Línea añadida con éxito');

        // $this->emit('presupuestorefresh');
        // $this->emit('linearefresh');

        // $this->visible='';
        // $this->orden='';
        // $this->descripcion='';
        // $this->preciotarifa='0';
        // $this->precioventa='0';
        // $this->unidades='0';
        // $this->observaciones='';
    }

}
