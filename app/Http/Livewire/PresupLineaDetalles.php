<?php

namespace App\Http\Livewire;

use App\Models\{PresupuestoLinea,PresupuestoLineaDetalle,Producto,Accion};
use Livewire\Component;

class PresupLineaDetalles extends Component
{
    public $presupuestolinea;

    public function render()
    {
        $presuplineadetalles=PresupuestoLineaDetalle::where('presupuestolinea_id',$this->presupuestolinea->id)->get();
        $presupproductos=$presuplineadetalles->where('acciontipo_id','1');
        $presupimpresion=$presuplineadetalles->where('acciontipo_id','2');
        $presupacabados=$presuplineadetalles->where('acciontipo_id','3');
        $presupmanipulados=$presuplineadetalles->where('acciontipo_id','4');
        $presupembalajes=$presuplineadetalles->where('acciontipo_id','5');
        $presuptransportes=$presuplineadetalles->where('acciontipo_id','6');
        $presupexternos=$presuplineadetalles->where('acciontipo_id','7');

        $productos=Producto::orderBy('descripcion')->get();

        $acciones=Accion::orderBy('acciontipo_id')->orderBy('descripcion')->get();
        $impresion=$acciones->where('acciontipo_id','2');
        $acabados=$acciones->where('acciontipo_id','3');
        $manipulados=$acciones->where('acciontipo_id','4');
        $embalajes=$acciones->where('acciontipo_id','5');
        $transportes=$acciones->where('acciontipo_id','6');
        $externos=$acciones->where('acciontipo_id','7');

        $presuplinea=$this->presupuestolinea;
        return view('livewire.presup-linea-detalles',compact(['presupproductos','presupimpresion','presupacabados','presupmanipulados','presupembalajes','presuptransportes','presupexternos','productos','impresion','acabados','manipulados','embalajes','transportes','externos','presuplinea']));
    }
}
