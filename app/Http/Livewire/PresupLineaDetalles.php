<?php

namespace App\Http\Livewire;

use App\Models\{PresupuestoLineaDetalle,Producto,Accion, AccionTipo, PresupuestoLinea, PresupuestoControlpartida};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


use Livewire\Component;

class PresupLineaDetalles extends Component
{
    public $presupuestolinea;
    public $showEdit=false;
    public $deshabilitado='disabled';

    protected $listeners = [ 'presuplineadetallesrefresh' => '$refresh'];

    public function render(){
        $controlpartidas=$this->presupuestolinea->presupuesto->presupuestocontrolpartidas->where('activo',true)->pluck('acciontipo_id')->toArray();
        $presuplineadetalles=PresupuestoLineaDetalle::where('presupuestolinea_id',$this->presupuestolinea->id)->orderBy('orden')->get();
        $presupproductos=$presuplineadetalles->where('acciontipo_id','1');
        $presupimpresion=$presuplineadetalles->where('acciontipo_id','2');
        $presupacabados=$presuplineadetalles->where('acciontipo_id','3');
        $presupmanipulados=$presuplineadetalles->where('acciontipo_id','4');
        $presupembalajes=$presuplineadetalles->where('acciontipo_id','5');
        $presuptransportes=$presuplineadetalles->where('acciontipo_id','6');
        $presupexternos=$presuplineadetalles->where('acciontipo_id','7');

        $productos=Producto::where('activo','1')->orderBy('descripcion')->get();

        $acciones=Accion::orderBy('acciontipo_id')->orderBy('descripcion')->get();
        $acciontipos=AccionTipo::orderBy('id')->get();
        $presuplinea=$this->presupuestolinea;
        return view('livewire.presup-linea-detalles',compact(['acciontipos','acciones','presuplineadetalles','presuplinea','controlpartidas']));
    }

    public function changeValor(PresupuestoLineaDetalle $presupaccion,$campo,$calculo,$valor){
        $preciominimo=0;
        if($presupaccion->acciontipo->nombrecorto!='MAT' && $presupaccion->acciontipo->nombrecorto!='EMB')
            $preciominimo=Accion::find($presupaccion->accionproducto_id)->preciominimo;
        else
            $preciominimo=Producto::find($presupaccion->accionproducto_id)->preciocoste;

        if(!Auth::user()->hasRole('Admin') && $presupaccion->producto->referencia=="Pedido Mínimo")
            $this->dispatchBrowserEvent("notify", "Este valor solo lo puede modificar Dirección Comercial.");
        else{
            //Preparamos y validamos antes de actualizar
            if($campo=="unidades") if(!$valor) $valor=1;
            if($campo=="preciocompra_ud") if(!$valor) $valor=0;

            if($campo=="precioventa_ud"){
                if($valor<$preciominimo){
                    $this->dispatchBrowserEvent("notify", "El precio de venta es inferior al mínimo. Se asignará el mínimo.");
                    $valor=$preciominimo;
                }
            }

            if ($campo=="factor") {
                $factormin=$presupaccion->empresaTipo->factormin ?? '1';
                if ($valor<$factormin) {
                    $this->dispatchBrowserEvent("notify", "El factor es inferior al mínimo. Se asignará el mínimo.");
                    $valor=$factormin;
                }
            }
            if($calculo=='concalculo') Validator::make([$campo=>$valor],[$campo=>'numeric|required'])->validate();
            //Actualizamos
            if($campo=="factor"){
                $presupaccion->update(['factor'=>$valor,'precioventa_ud'=>round($presupaccion->preciocoste_ud * $valor,2)]);
            }
            else{
                // dd($campo.'-'.$valor);
                $presupaccion->update([$campo=>$valor]);
            }

            // dd($presupaccion);
            // Recalculamos
            if($calculo=='concalculo') $this->calculoPrecioVenta($presupaccion);
            if($calculo=='sincalculo') $this->dispatchBrowserEvent('notify', 'Actualizado.');
            $this->emit('linearefresh');
        }
    }

    public function calculoPrecioVenta($presupacciondetalle){
        $presupacciondetalle->preciocoste=$presupacciondetalle->preciocoste_ud * $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * $presupacciondetalle->minutos ;
        $presupacciondetalle->precioventa= $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * $presupacciondetalle->minutos * ($presupacciondetalle->precioventa_ud  + $presupacciondetalle->preciocoste_ud * $presupacciondetalle->merma);

        $presupacciondetalle->preciocoste_ud=round($presupacciondetalle->preciocoste_ud,2);
        $presupacciondetalle->preciocoste=round($presupacciondetalle->preciocoste,2);
        $presupacciondetalle->precioventa=round($presupacciondetalle->precioventa,2);
        $presupacciondetalle->save();

        $this->dispatchBrowserEvent('notify', 'Precio actualizado.');
        $this->save($presupacciondetalle);
    }

    public function presentaficheroexterno(PresupuestoLineaDetalle $linea){
        $existe=Storage::disk('presupuestosexternos')->exists($linea->ruta.'/'.$linea->fichero);
        if ($existe)
            return Storage::disk('presupuestosexternos')->download($linea->ruta.'/'.$linea->fichero);
        else{
            $this->dispatchBrowserEvent('notifyred', 'Ha habido un problema con el fichero');
        }
    }

    public function actualizaPartida($presuplineadetalle){
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

    public function replicateRow(PresupuestoLineaDetalle $lineadetalle){
        $lineadetalle->clonarlinea();
        $this->dispatchBrowserEvent('notify', 'Linea copiada!');
        $this->emit('presuplineadetallerefresh');
    }

    public function save($presupacciondetalle){
        $presuplinea=$presupacciondetalle->presupuestolinea;
        $pl=$presuplinea->recalculo();
        $p=$presuplinea->presupuesto->recalculo();
        return redirect()->route('presupuestolinea.index',$presuplinea);
        $this->dispatchBrowserEvent('notify', 'Precio venta actualizado.');

    }

    public function delete($lineaId){
        $lineaBorrar = PresupuestoLineaDetalle::find($lineaId);
        if(!Auth::user()->hasRole('Admin') && $lineaBorrar->producto->descripcion=="Pedido Mínimo"){
            $this->dispatchBrowserEvent("notify", "Este valor solo lo puede modificar Dirección Comercial.");
}
        else{
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
}
