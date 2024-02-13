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
        if($presupuesto->pminimo->count()==0)
            $this->pedidominimo($this->presupuesto,$presupuestolinea);
        return redirect()->route('presupuesto.edit',$presupuesto);

    }

    function pedidominimo($presupuesto,$presupuestolinea) {
        $producto=Producto::where('descripcion','Pedido Minimo')->first();
        $empresa=Entidad::find($presupuesto->entidad_id);
        $pldetalle = PresupuestoLineaDetalle::create([
            'presupuestolinea_id'=>$presupuestolinea->id,
            'acciontipo_id'=>'1',
            'accionproducto_id'=>$producto->id,
            'empresatipo_id'=>$empresa->empresatipo_id,
            'entidad_id'=>$presupuesto->entidad_id,
            'incrementoanual'=>$empresa->incrementoanual,
            'orden'=>'1',
            'descripcion'=>$producto->descripcion,
            'preciocoste_ud'=>$empresa->empresatipo->pedidominimo,
            'precioventa_ud'=>$empresa->empresatipo->pedidominimo,
            'udpreciocoste_id'=>'6',
            'factor'=>'1',
            'merma'=>'0',
            'unidades'=>'1',
            'minutos'=>'1',
            'alto'=>'1',
            'ancho'=>'1',
            'preciocoste'=>$empresa->empresatipo->pedidominimo,
            'precioventa'=>$empresa->empresatipo->pedidominimo,
            'observaciones'=>'',
            'fichero'=>'',
            'ruta'=>'',
        ]);
        $pl=$presupuestolinea->recalculo();
        $p=$presupuesto->recalculo();
        // return redirect()->route('presupuestolinea.create',[$presupaccion->presupuestolinea,$presupaccion->acciontipo_id]);

        // $this->recalcular($pldetalle);
        // $this->actualizaPartida();

        // return redirect()->route('presupuestolinea.create',[$this->presuplinea,$this->acciontipo->id]);
    }
    }


