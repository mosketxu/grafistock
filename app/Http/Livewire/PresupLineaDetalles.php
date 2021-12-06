<?php

namespace App\Http\Livewire;

use App\Models\{PresupuestoLineaDetalle,Producto,Accion, AccionTipo, Presupuesto, PresupuestoLinea, PresupuestoControlpartida};
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class PresupLineaDetalles extends Component
{
    public $presupuestolinea;

    protected $listeners = [ 'presuplineadetallesrefresh' => '$refresh'];

    public function render()
    {
        $presuplineadetalles=PresupuestoLineaDetalle::where('presupuestolinea_id',$this->presupuestolinea->id)->orderBy('orden')->get();
        $presupproductos=$presuplineadetalles->where('acciontipo_id','1');
        $presupimpresion=$presuplineadetalles->where('acciontipo_id','2');
        $presupacabados=$presuplineadetalles->where('acciontipo_id','3');
        $presupmanipulados=$presuplineadetalles->where('acciontipo_id','4');
        $presupembalajes=$presuplineadetalles->where('acciontipo_id','5');
        $presuptransportes=$presuplineadetalles->where('acciontipo_id','6');
        $presupexternos=$presuplineadetalles->where('acciontipo_id','7');

        $productos=Producto::orderBy('descripcion')->get();

        $acciones=Accion::orderBy('acciontipo_id')->orderBy('descripcion')->get();
        $acciontipos=AccionTipo::orderBy('id')->get();
        $presuplinea=$this->presupuestolinea;
        return view('livewire.presup-linea-detalles',compact(['acciontipos','acciones','presuplineadetalles','presuplinea']));
    }

    public function changeVisible(PresupuestoLineaDetalle $presupaccion,$visible)
    {
        $visible=$visible==false ? true : false;
        Validator::make(['visible'=>$visible],[
            'visible'=>'boolean',
        ])->validate();
        $presupaccion->update(['visible'=>$visible]);
        $this->dispatchBrowserEvent('notify', 'Visible actualizado.');
    }

    public function changeOrden(PresupuestoLineaDetalle $presupaccion,$orden)
    {
        Validator::make(['orden'=>$orden],[
            'orden'=>'numeric',
        ])->validate();
        $presupaccion->update(['orden'=>$orden]);
        $this->dispatchBrowserEvent('notify', 'Orden Actualizado.');
    }

    public function changeDescripcion(PresupuestoLineaDetalle $presupaccion,$descripcion)
    {
        Validator::make(['descripcion'=>$descripcion],[
            'descripcion'=>'required',
        ])->validate();
        $presupaccion->update(['descripcion'=>$descripcion]);
        $this->dispatchBrowserEvent('notify', 'Descripción Actualizado.');
    }

    public function changeAncho(PresupuestoLineaDetalle $presupaccion,$ancho)
    {
        Validator::make(['ancho'=>$ancho],[
            'ancho'=>'numeric|required',
        ])->validate();
        $presupaccion->update([
            'ancho'=>$ancho,
            'metros2'=>round($ancho * $presupaccion->alto,2),
        ]);
        $this->calculoPrecioVenta($presupaccion);
    }

    public function changeAlto(PresupuestoLineaDetalle $presupaccion,$alto)
    {
        Validator::make(['alto'=>$alto],[
            'alto'=>'numeric|required',
        ])->validate();
        $presupaccion->update([
            'alto'=>$alto,
            'metros2'=>round($alto * $presupaccion->ancho,2),
        ]);
        $this->calculoPrecioVenta($presupaccion);
    }

    public function changeFactor(PresupuestoLineaDetalle $presupaccion,$factor)
    {
        Validator::make(['factor'=>$factor],[
            'factor'=>'numeric|required',
        ])->validate();

        $factormin=$presupaccion->presupuestolinea->presupuesto->entidad->empresatipo->factormin;

        if($factor<$factormin){
            $this->dispatchBrowserEvent("notify", "El factor es inferior al mínimo. Se asignará el mínimo.");
            $factor=$factormin ?? '1';
        }
        $presupaccion->update([
            'factor'=>$factor,
        ]);
        $this->calculoPrecioVenta($presupaccion);
    }

    public function changeMerma(PresupuestoLineaDetalle $presupaccion,$merma)
    {
        Validator::make(['merma'=>$merma],[
            'merma'=>'numeric|required',
        ])->validate();

        $mermamin=$presupaccion->producto->tipo->merma;
        if($merma<$mermamin){
            $this->dispatchBrowserEvent("notify", "La merma es inferior al mínimo. Se asignará el mínimo.");
            $merma=$mermamin;
        }
        $presupaccion->update([
            'merma'=>$merma,
        ]);

        $this->calculoPrecioVenta($presupaccion);

    }

    public function changeUnidades(PresupuestoLineaDetalle $presupaccion,$unidades)
    {
        Validator::make(['unidades'=>$unidades],[
            'unidades'=>'numeric|nullable',
            ])->validate();
        $presupaccion->update(['unidades'=>$unidades]);

        $this->calculoPrecioVenta($presupaccion);

    }

    public function changeObs(PresupuestoLineaDetalle $presupaccion,$observaciones)
    {
        Validator::make(['observaciones'=>$observaciones],[
            'observaciones'=>'nullable',
        ])->validate();
        $presupaccion->update(['observaciones'=>$observaciones]);
        $this->dispatchBrowserEvent('notify', 'Observación actualizada.');

    }

    public function calculoPrecioVenta($presupacciondetalle)
    {
        $presupacciondetalle->preciotarifa=round($presupacciondetalle->metros2 * $presupacciondetalle->preciotarifa_ud *  $presupacciondetalle->unidades,2);
        $presupacciondetalle->precioventa=round($presupacciondetalle->preciotarifa * ($presupacciondetalle->factor + $presupacciondetalle->merma) ,2);
        $presupacciondetalle->save();
        $this->dispatchBrowserEvent('notify', 'Precio venta actualizado.');
        $this->save($presupacciondetalle);
    }

    public function actualizaPartida($presuplineadetalle)
    {
        $contador=PresupuestoLinea::query()
            ->join('presupuesto_linea_detalles', 'presupuesto_lineas.id', '=', 'presupuesto_linea_detalles.presupuestolinea_id')
            ->select('presupuesto_lineas.presupuesto_id', 'presupuesto_linea_detalles.acciontipo_id')
            ->where('presupuesto_lineas.presupuesto_id', $presuplineadetalle->presupuestolinea->presupuesto_id)
            ->where('presupuesto_linea_detalles.acciontipo_id', $presuplineadetalle->acciontipo_id)
            ->count();

        $p=PresupuestoControlpartida::query()
        ->where('presupuesto_id', $presuplineadetalle->presupuestolinea->presupuesto_id)
        ->where('acciontipo_id', $presuplineadetalle->acciontipo_id)
        ->update([
            'contador'=>$contador
        ]);
    }

    public function save($presupacciondetalle)
    {
        $presuplinea=$presupacciondetalle->presupuestolinea;
        $pl=$presuplinea->recalculo();
        $p=$presuplinea->presupuesto->recalculo();
        return redirect()->route('presupuestolinea.index',$presuplinea);
    }

    public function delete($lineaId)
    {
        $lineaBorrar = PresupuestoLineaDetalle::find($lineaId);

        $presuplinea=$lineaBorrar->presupuestolinea;
        if ($lineaBorrar) {
            $lineaBorrar->delete();
            $pl=$presuplinea->recalculo();
            $p=$presuplinea->presupuesto->recalculo();
            $this->dispatchBrowserEvent('notify', 'Linea de presupuesto eliminada!');
            $this->actualizaPartida($lineaBorrar);
            return redirect()->route('presupuestolinea.index',$presuplinea);
        }
    }
}
