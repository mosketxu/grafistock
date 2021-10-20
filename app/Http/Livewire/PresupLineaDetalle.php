<?php

namespace App\Http\Livewire;

use App\Models\Accion;
use App\Models\AccionTipo;
use App\Models\PresupuestoLineaDetalle;
use Livewire\Component;

class PresupLineaDetalle extends Component
{
    public $acciontipoId;
    public $presupuestolinea;
    public $presupuestolineadetalleId='';
    public AccionTipo $acciontipo;

    public $visible=true;
    public $orden=1;
    public $descripcion;
    public $preciocoste=0;
    public $precioventa=0;
    public $ratio=1;
    public $unidades=1;
    public $accion_id;
    public $observaciones;

    protected $rules = [
        'visible'=>'',
        'orden'=>'nullable|numeric',
        'descripcion'=>'required',
        'preciocoste'=>'nullable|numeric',
        'precioventa'=>'nullable|numeric',
        'ratio'=>'nullable|numeric',
        'unidades'=>'nullable|numeric',
        'accion_id'=>'required',
    ];

    public function render()
    {
        $this->acciontipo=AccionTipo::find($this->acciontipoId);
        $acciones=Accion::where('acciontipo_id',$this->acciontipoId)->orderBy('descripcion')->get();
        return view('livewire.presup-linea-detalle',compact('acciones'));
    }

    public function UpdatedAccionId()
    {

        $a=Accion::find($this->accion_id);
        $this->preciocoste=$a->preciocoste;
        $this->precioventa=$a->precioventa;
    }

    public function save()
    {
        $this->ratio= !$this->ratio ? 1 : $this->ratio;

        $this->validate();
        $presupuesto = PresupuestoLineaDetalle::updateOrCreate(['id' => $this->presupuestolineadetalleId], [
            'acciontipo_id'=>$this->acciontipoId,
            'accion_id'=>$this->accion_id,
            'presupuestolinea_id'=>$this->presupuestolinea->id,
            'orden'=>$this->orden,
            'descripcion'=>$this->descripcion,
            'preciocoste'=>$this->preciocoste,
            'precioventa'=>$this->precioventa,
            'ratio'=>$this->ratio,
            'unidades'=>$this->unidades,
            'observaciones'=>$this->observaciones,

        ]);

        $this->dispatchBrowserEvent('notify', 'Línea añadida con éxito');

        // $p=Presupuesto::find($this->presupuesto->id)->recalculo();
        // $this->emit('presupuestorefresh');
        // $this->emit('linearefresh');

        $this->descripcion='';
        $this->preciocoste='0';
        $this->precioventa='0';
        $this->unidades='0';
        $this->observaciones='';
    }
}
