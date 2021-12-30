<?php

namespace App\Http\Livewire;

use App\Models\{Producto,Accion,AccionTipo, EmpresaTipo, Entidad, PresupuestoControlpartida, PresupuestoLinea,PresupuestoLineaDetalle, ProductoFamilia, UnidadCoste};
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class PresupLineaDetalle extends Component
{
    public $showEdit=true;
    public $acciontipoId;
    public $filtrofamilia='';
    public $filtrodescripcion='';
    public $presuplinea;
    public $presupuestolinea_id;
    public $presupuestolinea;
    public $presupuestolineadetalleId='';
    public $accionproducto;
    public $showAnchoAlto=false;
    public $showMinutos=false;
    public $controlpartidas;
    public $deshabilitadoPVenta='';
    public $deshabilitadoPCoste='disabled';
    public $colorfondoCoste='';
    public $colorfondoVenta='';
    public $descrip='';

    public AccionTipo $acciontipo;

    public $empresaTipo;

    public $visible=true;
    public $orden=1;
    public $pldetalleId='';
    public $descripcion;
    public $proveedor_id;
    public $preciocoste_ud=0;
    public $preciocoste=0;
    public $precioventa_ud=0;
    public $preciominimo=0;
    public $udpreciocoste_id;
    public $unidadventa='';
    public $factor=1;
    public $factormin=1;
    public $merma;
    public $ancho=1;
    public $alto=1;
    public $unidades=1;
    public $minutos=1;
    public $accionproducto_id;
    public $observaciones;

    protected $rules = [
        'visible'=>'',
        'orden'=>'nullable|numeric',
        'proveedor_id'=>'nullable|numeric',
        'preciocoste_ud'=>'nullable|numeric',
        'precioventa_ud'=>'nullable|numeric',
        'precioventa'=>'nullable|numeric',
        // 'udpreciocoste_id'=>'numeric',
        'ancho'=>'nullable|numeric',
        'alto'=>'nullable|numeric',
        // 'metros2'=>'nullable|numeric',
        'factor'=>'nullable|numeric',
        'merma'=>'nullable|numeric',
        'unidades'=>'nullable|numeric',
        'minutos'=>'numeric',
        'accionproducto_id'=>'required',
    ];

    protected $listeners = [ 'presuplineadetallerefresh' => '$refresh'];

    public function mount(PresupuestoLinea $presupuestolinea)
    {
        $this->presuplinea=$presupuestolinea;
        $this->empresaTipo=EmpresaTipo::find($presupuestolinea->presupuesto->entidad->empresatipo_id);
        $this->controlpartidas=$this->presuplinea->presupuesto->presupuestocontrolpartidas;
        $this->acciontipo=AccionTipo::find($this->acciontipoId);
        $condiciones=['IMP','ACA','MAN','TRA'];
        if(in_array($this->acciontipo->nombrecorto, $condiciones)){
            $this->deshabilitadoPCoste='disabled';
            $this->colorfondoPCoste='bg-gray-100';
        }
    }

    public function render()
    {
        $familias=ProductoFamilia::where('id','<>','16')->orderBy('nombre')->get();
        $proveedores='';
        if($this->acciontipo->nombrecorto=='EXT'){
            $proveedores=Entidad::whereIn('entidadtipo_id', ['2', '3'])->where('presupuesto',true)->orderBy('entidad')->get();
        }

        $presupacciones=PresupuestoLineaDetalle::where('presupuestolinea_id',$this->presuplinea->id)->where('acciontipo_id',$this->acciontipoId)->orderBy('orden')->get();

        $this->tituloaccion=$this->acciontipo->nombre;

        if($this->acciontipo->nombrecorto!='MAT' && $this->acciontipo->nombrecorto!='EMB')
            $acciones=Accion::where('acciontipo_id',$this->acciontipoId)->orderBy('descripcion')->get();
        else{
            if($this->acciontipo->nombrecorto=='MAT'){
                $acciones=Producto::query()
                    ->search('referencia',$this->filtrodescripcion)
                    ->orSearch('descripcion',$this->filtrodescripcion)
                    ->when($this->filtrofamilia!='', function ($query){
                        $query->where('familia_id',$this->filtrofamilia);
                    })
                    ->where('descripcion','<>',' Genérico')
                    ->orderBy('descripcion','asc')
                    ->get();
            }
            else{
                $acciones=Producto::query()
                    ->search('referencia',$this->filtrodescripcion)
                    ->orSearch('descripcion',$this->filtrodescripcion)
                    ->where('familia_id','16')
                    ->orderBy('referencia','asc')
                    ->get();
            }
        }

        $unidadesventa=UnidadCoste::orderBy('nombre')->get();

        return view('livewire.presup-linea-detalle',compact('acciones','presupacciones','familias','proveedores','unidadesventa'));
    }

    public function edit(PresupuestoLineaDetalle $presupuestoaccion)
    {

            $this->presupuestolinea_id=$presupuestoaccion->id;
            $this->acciontipo_id=$presupuestoaccion->acciontipo_id;
            $this->accionproducto_id=$presupuestoaccion->accionproducto_id;
            $this->entidad_id=$presupuestoaccion->entidad_id;
            $this->orden=$presupuestoaccion->orden;
            $this->descripcion=$presupuestoaccion->descripcion;
            $this->preciocoste_ud=$presupuestoaccion->preciocoste_ud;
            $this->precioventa_ud=$presupuestoaccion->precioventa_ud;
            $this->udpreciocoste_id=$presupuestoaccion->udpreciocoste_id;
            $this->factor=$presupuestoaccion->factor;
            $this->merma=$presupuestoaccion->merma;
            $this->unidades=$presupuestoaccion->unidades;
            $this->minutos=$presupuestoaccion->minutos;
            $this->alto=$presupuestoaccion->alto;
            $this->ancho=$presupuestoaccion->ancho;
            $this->preciocoste=$presupuestoaccion->preciocoste;
            $this->precioventa=$presupuestoaccion->precioventa;
            $this->observaciones=$presupuestoaccion->observaciones;

            $ud=$presupuestoaccion->unidadpreciocoste->nombrecorto ?? '';
            $this->showAnchoAlto= $ud=='e_m2' ? true : false;
            $this->showMinutos= $ud=='e_min' ? true : false;

    }

    public function UpdatedAccionproductoId()
    {
        // $this->mermamin=0;
        $this->merma=0;
        $this->factor=1;
        $this->factormin=1;
        $this->preciocoste_ud=0;
        $this->precioventa_ud=0;
        $this->preciominimo=0;
        $this->udpreciocoste_id='';
        $this->unidadventa='';

        if($this->accionproducto_id!=''){
            if($this->acciontipo->nombrecorto!='MAT' && $this->acciontipo->nombrecorto!='EMB'){
                $this->accionproducto=Accion::find($this->accionproducto_id);
                $this->preciocoste_ud=$this->accionproducto->preciocoste;
                $this->precioventa_ud=$this->accionproducto->precioventa;
                $this->preciominimo=$this->accionproducto->preciominimo;
                $this->udpreciocoste_id=$this->accionproducto->udpreciocoste_id;
                $this->unidadventa=$this->accionproducto->unidadpreciocoste->nombrecorto ?? '';
                $this->descrip=$this->accionproducto->descripcion;
                if($this->descrip==' Genérico'){
                    $this->deshabilitadoPCoste='';
                    $this->colorfondoCoste='';
                }

            }else{
                $this->accionproducto=Producto::find($this->accionproducto_id);
                $this->descrip=$this->accionproducto->descripcion;
                if ($this->descrip!=' Genérico') {
                    $this->preciocoste_ud=$this->accionproducto->preciocoste;
                    // $this->mermamin=$this->accionproducto->tipo->merma;
                    $this->merma=$this->accionproducto->tipo->merma;
                    $this->factor=$this->empresaTipo->factor ?? '1';
                    $this->factormin=$this->empresaTipo->factormin ?? '1';
                    $this->precioventa_ud=round($this->preciocoste_ud * $this->factor, 2);
                    $this->udpreciocoste_id=$this->accionproducto->udpreciocoste_id;
                    $this->unidadventa=$this->accionproducto->unidadpreciocoste->nombrecorto ?? '';
                    $this->deshabilitadoPCoste='disabled';
                    $this->colorfondoPCoste='bg-gray-100';
                }else{
                    $this->preciocoste_ud='0';
                    // $this->mermamin='0';
                    $this->merma='0';
                    $this->factor='1';
                    $this->factormin='1';
                    $this->precioventa_ud='0';
                    $this->udpreciocoste_id='';
                    $this->unidadventa='';
                    $this->deshabilitadoPCoste='';
                    $this->colorfondoCoste='';
                }
            }

            $ud=$this->accionproducto->unidadpreciocoste->nombrecorto ?? '';
            $this->showAnchoAlto= $ud=='e_m2' ? true : false;
            $this->showMinutos= $ud=='e_min' ? true : false;

            $this->emit('presuplineadetallerefresh');
        }

        $this->calculoPrecioVenta();
    }

    public function UpdatedUdpreciocosteId(){
        $this->showAnchoAlto= UnidadCoste::find($this->udpreciocoste_id)->nombrecorto=='e_m2' ? true : false;
        $this->showMinutos= UnidadCoste::find($this->udpreciocoste_id)->nombrecorto=='e_min' ? true : false;
    }

    public function UpdatedUnidades(){$this->validate(['unidades'=>'numeric',]);$this->calculoPrecioVenta();}

    public function UpdatedMinutos(){$this->validate(['minutos'=>'numeric',]);$this->calculoPrecioVenta();}

    public function UpdatedAncho(){ $this->validate(['ancho'=>'numeric',]);$this->calculoPrecioVenta();}

    public function UpdatedAlto(){$this->validate(['alto'=>'numeric',]);$this->calculoPrecioVenta();}




    // con el factor tenemos en cuenta el minimo
    public function UpdatedFactor(){
        $this->validate(['factor'=>'numeric',]);
        if($this->factor<$this->factormin){
            $this->dispatchBrowserEvent("notify", "El factor es inferior al mínimo. Se asignará el mínimo.");
            $this->factor=$this->factormin;
        }
        // $this->precioventa_ud=round($this->preciocoste_ud * $this->factor,2);
        $this->calculoPrecioVenta();
    }

    // con la merma tenemos en cuenta el minimo
    public function UpdatedMerma(){
        $this->validate(['merma'=>'numeric']);
        // if($this->merma<$this->mermamin){
        //     $this->dispatchBrowserEvent("notify", "La merma es inferior a la mínima. Se asignará la mínima.");
        //     $this->merma=$this->mermamin ?? '0';
        // }
        $this->calculoPrecioVenta();
    }

    // con el precio de venta tenemos en cuenta el minimo
    public function UpdatedPrecioventaUd(){
        if($this->preciominimo=='0') $this->preciominimo=$this->preciocoste_ud;
        if($this->precioventa_ud<$this->preciominimo){
            $this->dispatchBrowserEvent("notify", "El precio de venta es inferior al mínimo. Se asignará el mínimo.");
            $this->precioventa_ud=$this->preciominimo;
        }
        $this->validate(['precioventa_ud'=>'numeric']);
        $this->calculoPrecioVenta();
    }

    public function changeVisible(PresupuestoLineaDetalle $presupaccion,$visible)
    {
        $visible=$visible==false ? true : false;
        Validator::make(['visible'=>$visible],['visible'=>'boolean'])->validate();
        $presupaccion->update(['visible'=>$visible]);
        $this->dispatchBrowserEvent('notify', 'Visible Actualizado.');
    }

    public function changeOrden(PresupuestoLineaDetalle $presupaccion,$orden)
    {
        Validator::make(['orden'=>$orden],['orden'=>'numeric'])->validate();
        $presupaccion->update(['orden'=>$orden]);
        $this->dispatchBrowserEvent('notify', 'Orden Actualizado.');
        $this->emit('linearefresh');
    }

    public function changeDescripcion(PresupuestoLineaDetalle $presupaccion,$descripcion)
    {
        Validator::make(['descripcion'=>$descripcion],['descripcion'=>'required'])->validate();
        $presupaccion->update(['descripcion'=>$descripcion]);
        $this->dispatchBrowserEvent('notify', 'Descripción Actualizada.');
    }

    public function changeObs(PresupuestoLineaDetalle $presupaccion,$observaciones)
    {
        $presupaccion->update(['observaciones'=>$observaciones]);
        $this->dispatchBrowserEvent('notify', 'Observación Actualizada.');
    }

    public function changeAncho(PresupuestoLineaDetalle $presupaccion,$ancho)
    {
        Validator::make(['ancho'=>$ancho],['ancho'=>'numeric|required'])->validate();
        $presupaccion->update(['ancho'=>$ancho]);
        $this->recalculoPrecioVenta($presupaccion);
        $this->dispatchBrowserEvent('notify', 'Ancho y Precio Venta actualizados.');
    }

    public function changeAlto(PresupuestoLineaDetalle $presupaccion,$alto)
    {
        Validator::make(['alto'=>$alto],['alto'=>'numeric|required'])->validate();
        $presupaccion->update(['alto'=>$alto,'metros2'=>round($alto * $presupaccion->ancho ,2)]);
        $this->recalculoPrecioVenta($presupaccion);
        $this->dispatchBrowserEvent('notify', 'Alto y Precio Venta Actualizados.');
    }

    public function changeUnidades(PresupuestoLineaDetalle $presupaccion,$unidades)
    {
        Validator::make(['unidades'=>$unidades],['unidades'=>'numeric|required'])->validate();
        $presupaccion->update(['unidades'=>$unidades,]);
        $this->recalculoPrecioVenta($presupaccion);
        $this->dispatchBrowserEvent('notify', 'Unidades y Precio Venta Actualizados.');
    }

    public function changeMinutos(PresupuestoLineaDetalle $presupaccion,$minutos)
    {
        Validator::make(['minutos'=>$minutos],['minutos'=>'numeric|required'])->validate();
        $presupaccion->update(['minutos'=>$minutos,]);
        $this->recalculoPrecioVenta($presupaccion);
        $this->dispatchBrowserEvent('notify', 'Minutos y Precio Venta Actualizados.');
    }

    public function changeFactor(PresupuestoLineaDetalle $presupaccion,$factor)
    {
        Validator::make(['factor'=>$factor],['factor'=>'numeric|required',])->validate();
        if($factor<$this->factormin){
            $this->dispatchBrowserEvent("notify", "El factor es inferior al mínimo. Se asignará el mínimo.");
            $factor=$this->factormin;
        }
        $presupaccion->update(['factor'=>$factor]);
        $this->recalculoPrecioVenta($presupaccion);
        $this->dispatchBrowserEvent('notify', 'Unidades y Precio Venta Actualizados.');
    }

    public function changePrecioventaUd(PresupuestoLineaDetalle $presupaccion,$precioventa_ud)
    {
        Validator::make(['precioventa_ud'=>$precioventa_ud],['precioventa_ud'=>'numeric|required',])->validate();
        if($precioventa_ud<$this->preciominimo){
            $this->dispatchBrowserEvent("notify", "El precio de venta es inferior al mínimo. Se asignará el mínimo.");
            $precioventa_ud=$this->preciominimo;
        }
        $presupaccion->update(['precioventa_ud'=>$precioventa_ud,]);
        $this->recalculoPrecioVenta($presupaccion);
        $this->dispatchBrowserEvent('notify', 'Precio venta unidad y Precio Venta Actualizados.');
    }

    public function changeMerma(PresupuestoLineaDetalle $presupaccion,$merma)
    {
        Validator::make(['merma'=>$merma],['merma'=>'numeric|required'])->validate();
        // $mermamin=$presupaccion->producto->tipo->merma;
        // if($merma<$mermamin){
        //     $this->dispatchBrowserEvent("notify", "La merma es inferior al mínimo. Se asignará el mínimo.");
        //     $merma=$mermamin;
        // }
        $presupaccion->update(['merma'=>$merma,]);
        $this->recalculoPrecioVenta($presupaccion);
        $this->dispatchBrowserEvent('notify', 'Merma y Precio Venta Actualizados.');
    }

    public function save()
    {
        if($this->accionproducto_id){
            if(!$this->udpreciocoste_id) $this->udpreciocoste_id='2';
            $this->validate();

            $pldetalle = PresupuestoLineaDetalle::updateOrCreate(['id'=>$this->presupuestolinea_id], [
                'presupuestolinea_id'=>$this->presuplinea->id,
                'acciontipo_id'=>$this->acciontipoId,
                'accionproducto_id'=>$this->accionproducto_id,
                'entidad_id'=>$this->proveedor_id,
                'orden'=>$this->orden,
                'descripcion'=>$this->descripcion,
                'preciocoste_ud'=>$this->preciocoste_ud,
                'precioventa_ud'=>$this->precioventa_ud,
                'udpreciocoste_id'=>$this->udpreciocoste_id,
                'factor'=>$this->factor,
                'merma'=>$this->merma,
                'unidades'=>$this->unidades,
                'minutos'=>$this->minutos,
                'alto'=>$this->alto,
                'ancho'=>$this->ancho,
                'preciocoste'=>$this->preciocoste,
                'precioventa'=>$this->precioventa,
                // 'metros2'=>$this->metros2,
                'observaciones'=>$this->observaciones,
            ]);

            $this->recalcular($pldetalle);
            $this->actualizaPartida();

            return redirect()->route('presupuestolinea.create',[$this->presuplinea,$this->acciontipo->id]);
        }
    }

    public function recalcular($presupaccion)
    {
        $pl=$presupaccion->presupuestolinea->recalculo();
        $p=$presupaccion->presupuestolinea->presupuesto->recalculo();
        return redirect()->route('presupuestolinea.create',[$presupaccion->presupuestolinea,$presupaccion->acciontipo_id]);
    }

    public function calculoPrecioVenta()
    {
        if($this->acciontipoId!='1'){
            $this->preciocoste=$this->preciocoste_ud * $this->ancho * $this->alto * $this->unidades * $this->minutos;
            $this->precioventa=$this->precioventa_ud * $this->ancho * $this->alto * $this->unidades * $this->minutos ;
        }else{
            $this->preciocoste=$this->preciocoste_ud * $this->ancho * $this->alto * $this->unidades * $this->minutos ;
            $this->precioventa=$this->ancho * $this->alto * $this->unidades * $this->minutos * ($this->precioventa_ud * $this->factor   + $this->preciocoste_ud*$this->merma);
            // dd($this->precioventa.'='.$this->ancho .'*'. $this->alto .'*'. $this->unidades .'*'. '('.$this->precioventa_ud .'*'. $this->factor   .'+'. $this->preciocoste_ud.'*'.$this->merma.')');
        }
        $this->preciocoste=round($this->preciocoste,2);
        $this->precioventa=round($this->precioventa,2);
    }

    public function recalculoPrecioVenta($presupacciondetalle)
    {
        if($presupacciondetalle->acciontipo_id!='1'){
            $presupacciondetalle->preciocoste=$presupacciondetalle->preciocoste_ud * $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * $presupacciondetalle->minutos ;
            $presupacciondetalle->precioventa=$presupacciondetalle->precioventa_ud * $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * $presupacciondetalle->minutos ;
        }else{
            $presupacciondetalle->preciocoste=$presupacciondetalle->preciocoste_ud * $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * $presupacciondetalle->minutos ;
            $presupacciondetalle->precioventa= $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * $presupacciondetalle->minutos * ($presupacciondetalle->precioventa_ud *$presupacciondetalle->factor + $presupacciondetalle->preciocoste_ud *$presupacciondetalle->merma);
        }
        $presupacciondetalle->preciocoste=round($presupacciondetalle->preciocoste,2);
        $presupacciondetalle->precioventa=round($presupacciondetalle->precioventa,2);
        $presupacciondetalle->save();
        $this->dispatchBrowserEvent('notify', 'Precio actualizado.');

        $this->recalcular($presupacciondetalle);
        $this->actualizaPartida();
    }

    public function actualizaPartida()
    {
        $contador=PresupuestoLinea::query()
            ->join('presupuesto_linea_detalles','presupuesto_lineas.id','=','presupuesto_linea_detalles.presupuestolinea_id')
            ->select('presupuesto_lineas.presupuesto_id','presupuesto_linea_detalles.acciontipo_id')
            ->where('presupuesto_lineas.presupuesto_id',$this->presuplinea->presupuesto_id)
            ->where('presupuesto_linea_detalles.acciontipo_id',$this->acciontipoId)
            ->count();

        $p=PresupuestoControlpartida::query()
        ->where('presupuesto_id',$this->presuplinea->presupuesto_id)
        ->where('acciontipo_id',$this->acciontipoId)
        ->update([
            'contador'=>$contador
        ]);
    }

    public function delete($lineaId)
    {
        $lineaBorrar = PresupuestoLineaDetalle::find($lineaId);

        if ($lineaBorrar) {
            $lineaBorrar->delete();
            $this->recalcular($lineaBorrar);
            $this->dispatchBrowserEvent('notify', 'Linea de presupuesto eliminada!');
        }
            $this->actualizaPartida();
    }
}
