<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
use App\Models\Presupuesto;
use App\Models\PresupuestoLinea;
use App\Models\PresupuestoLineaDetalle;
use App\Models\Producto;
use Livewire\Component;

class PresupLineaCreate extends Component
{
public $presupuesto;

public $presupuesto_id;
public $visible=1;
public $orden=0;
public $descripcion;
public $preciocoste='0';
public $precioventa='0';
public $unidades='1';
public $fichero;
public $observaciones;

protected $rules = [
    'presupuesto_id'=>'required|numeric',
    'visible'=>'nullable',
    'orden'=>'nullable|numeric',
    'descripcion'=>'required',
    'preciocoste'=>'numeric',
    'precioventa'=>'numeric',
    'unidades'=>'required|numeric|gt:0',
    'observaciones'=>'nullable',

];

public function messages()
{
    return [
        'descripcion.required' => 'La descripcion es necesaria',
        'unidades.required' => 'Las unidades son necesarias',
        'unidades.numeric' => 'Las unidades deben ser un valor numeérico',
        'unidades.gt' => 'Las unidades deben ser superiores a 0',
    ];
}

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


        $presupuestolinea=PresupuestoLinea::create([
            'presupuesto_id'=>$this->presupuesto_id,
            'visible'=>$this->visible,
            'orden'=>$this->orden,
            'descripcion'=>$this->descripcion,
            'preciocoste'=>$this->preciocoste,
            'precioventa'=>$this->precioventa,
            'unidades'=>$this->unidades,
            'observaciones'=>$this->observaciones,
        ]);


        $presupuesto=Presupuesto::find($this->presupuesto->id);

        return redirect()->route('presupuesto.edit',$presupuesto);

    }


}


