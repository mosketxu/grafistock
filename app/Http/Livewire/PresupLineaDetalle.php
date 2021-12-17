<?php

namespace App\Http\Livewire;

use App\Models\{Producto,Accion,AccionTipo, EmpresaTipo, Entidad, PresupuestoControlpartida, PresupuestoLinea,PresupuestoLineaDetalle, ProductoFamilia, UnidadCoste};
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class PresupLineaDetalle extends Component
{
    public $acciontipoId;
    public $filtrofamilia='';
    public $filtrodescripcion='';
    public $presuplinea;
    public $presupuestolinea;
    public $presupuestolineadetalleId='';
    public $accionproducto;
    public $showAnchoAlto=false;
    public $controlpartidas;
    public $deshabilitadoPVenta='';
    public $deshabilitadoPTarifa='disabled';
    public $colorfondoTarifa='';
    public $colorfondoVenta='';
    public $descrip='';

    public AccionTipo $acciontipo;

    public $empresaTipo;

    public $visible=true;
    public $orden=1;
    public $pldetalleId='';
    public $descripcion;
    public $proveedor_id;
    public $preciotarifa_ud=0;
    public $precioventa_ud=0;
    public $preciominimo=0;
    public $udpreciotarifa_id;
    public $unidadventa='';
    public $factor=1;
    public $factormin=1;
    public $merma;
    public $mermamin;
    public $ancho=1;
    public $alto=1;
    public $metros2=0;
    public $unidades=1;
    public $accionproducto_id;
    public $observaciones;

    protected $rules = [
        'visible'=>'',
        'orden'=>'nullable|numeric',
        'proveedor_id'=>'nullable|numeric',
        'preciotarifa_ud'=>'nullable|numeric',
        'precioventa_ud'=>'nullable|numeric',
        'precioventa'=>'nullable|numeric',
        'udpreciotarifa_id'=>'required|numeric',
        'ancho'=>'nullable|numeric',
        'alto'=>'nullable|numeric',
        'metros2'=>'nullable|numeric',
        'factor'=>'nullable|numeric',
        'merma'=>'nullable|numeric',
        'unidades'=>'nullable|numeric',
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
            $this->deshabilitadoPTarifa='disabled';
            $this->colorfondoTarifa='bg-gray-100';
        }
    }

    public function render()
    {
        $familias=ProductoFamilia::where('id','<>','16')->orderBy('nombre')->get();
        $proveedores='';
        // $unidadesventa='';
        if($this->acciontipo->nombrecorto=='EXT'){
            $proveedores=Entidad::where('entidadtipo_id','2')->orWhere('entidadtipo_id','3')->get();
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

    public function UpdatedAccionproductoId()
    {
        $this->mermamin=0;
        $this->merma=0;
        $this->factor=1;
        $this->factormin=1;
        $this->preciotarifa_ud=0;
        $this->precioventa_ud=0;
        $this->preciominimo=0;
        $this->udpreciotarifa_id='';
        $this->unidadventa='';

        if($this->accionproducto_id!=''){
            if($this->acciontipo->nombrecorto!='MAT' && $this->acciontipo->nombrecorto!='EMB'){
                $this->accionproducto=Accion::find($this->accionproducto_id);
                $this->preciotarifa_ud=$this->accionproducto->preciotarifa;
                $this->precioventa_ud=$this->accionproducto->precioventa;
                $this->preciominimo=$this->accionproducto->preciominimo;
                $this->udpreciotarifa_id=$this->accionproducto->udpreciotarifa_id;
                $this->unidadventa=$this->accionproducto->unidadpreciotarifa->nombrecorto;
                $this->descrip=$this->accionproducto->descripcion;
                if($this->descrip==' Genérico'){
                    $this->deshabilitadoPTarifa='';
                    $this->colorfondoTarifa='';
                }

            }else{
                $this->accionproducto=Producto::find($this->accionproducto_id);
                $this->descrip=$this->accionproducto->descripcion;
                if ($this->descrip!=' Genérico') {
                    $this->preciotarifa_ud=$this->accionproducto->preciotarifa;
                    $this->mermamin=$this->accionproducto->tipo->merma;
                    $this->merma=$this->accionproducto->tipo->merma;
                    $this->factor=$this->empresaTipo->factor ?? '1';
                    $this->factormin=$this->empresaTipo->factormin ?? '1';
                    $this->precioventa_ud=round($this->preciotarifa_ud * $this->factor, 2);
                    $this->udpreciotarifa_id=$this->accionproducto->udpreciotarifa_id;
                    $this->unidadventa=$this->accionproducto->unidadpreciotarifa->nombrecorto;
                    $this->deshabilitadoPTarifa='disabled';
                    $this->colorfondoTarifa='bg-gray-100';
                }else{
                    $this->preciotarifa_ud='0';
                    $this->mermamin='0';
                    $this->merma='0';
                    $this->factor='1';
                    $this->factormin='1';
                    $this->precioventa_ud='0';
                    $this->udpreciotarifa_id='';
                    $this->unidadventa='';
                    $this->deshabilitadoPTarifa='';
                    $this->colorfondoTarifa='';
                }
            }

            if ($this->descrip!=' Genérico') {
                $this->showAnchoAlto= $this->accionproducto->unidadpreciotarifa->nombrecorto=='e_m2' ? true : false;
                $this->metros2=$this->alto * $this->ancho;
            }
            $this->emit('presuplineadetallerefresh');
        }

        $this->calculoPrecioVenta();
    }

    public function UpdatedUnidades(){$this->validate(['unidades'=>'numeric',]);$this->calculoPrecioVenta();}

    public function UpdatedAncho(){ $this->validate(['ancho'=>'numeric',]);$this->calculoPrecioVenta();}

    public function UpdatedAlto(){$this->validate(['alto'=>'numeric',]);$this->calculoPrecioVenta();}

    // con el factor tenemos en cuenta el minimo
    public function UpdatedFactor(){
        $this->validate(['factor'=>'numeric',]);
        if($this->factor<$this->factormin){
            $this->dispatchBrowserEvent("notify", "El factor es inferior al mínimo. Se asignará el mínimo.");
            $this->factor=$this->factormin;
        }
        $this->precioventa_ud=round($this->preciotarifa_ud * $this->factor,2);
        $this->calculoPrecioVenta();
    }

    // con la merma tenemos en cuenta el minimo
    public function UpdatedMerma(){
        $this->validate(['merma'=>'numeric']);
        if($this->merma<$this->mermamin){
            $this->dispatchBrowserEvent("notify", "La merma es inferior a la mínima. Se asignará la mínima.");
            $this->merma=$this->mermamin ?? '0';
        }
        $this->calculoPrecioVenta();
    }

    // con el precio de venta tenemos en cuenta el minimo
    public function UpdatedPrecioventaUd(){
        if($this->preciominimo=='0') $this->preciominimo=$this->preciotarifa_ud;
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
        $presupaccion->update(['ancho'=>$ancho,'metros2'=>round($ancho * $presupaccion->alto ,2)]);
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

    public function changeFactor(PresupuestoLineaDetalle $presupaccion,$factor)
    {
        Validator::make(['factor'=>$factor],['factor'=>'numeric|required',])->validate();
        if($factor<$this->factormin){
            $this->dispatchBrowserEvent("notify", "El factor es inferior al mínimo. Se asignará el mínimo.");
            $factor=$this->fmin;
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
        $mermamin=$presupaccion->producto->tipo->merma;
        if($merma<$mermamin){
            $this->dispatchBrowserEvent("notify", "La merma es inferior al mínimo. Se asignará el mínimo.");
            $merma=$mermamin;
        }
        $presupaccion->update(['merma'=>$merma,]);
        $this->recalculoPrecioVenta($presupaccion);
        $this->dispatchBrowserEvent('notify', 'Merma y Precio Venta Actualizados.');
    }

    public function save()
    {
        $this->validate();

        $pldetalle = PresupuestoLineaDetalle::updateOrCreate(['id'=>$this->pldetalleId], [
            'presupuestolinea_id'=>$this->presuplinea->id,
            'acciontipo_id'=>$this->acciontipoId,
            'accionproducto_id'=>$this->accionproducto_id,
            'entidad_id'=>$this->proveedor_id,
            'orden'=>$this->orden,
            'descripcion'=>$this->descripcion,
            'preciotarifa_ud'=>$this->preciotarifa_ud,
            'precioventa_ud'=>$this->precioventa_ud,
            'udpreciotarifa_id'=>$this->udpreciotarifa_id,
            'factor'=>$this->factor,
            'merma'=>$this->merma,
            'unidades'=>$this->unidades,
            'alto'=>$this->alto,
            'ancho'=>$this->ancho,
            'precioventa'=>$this->precioventa,
            'metros2'=>$this->metros2,
            'observaciones'=>$this->observaciones,
        ]);

        $this->recalcular($pldetalle);
        $this->actualizaPartida();

        return redirect()->route('presupuestolinea.create',[$this->presuplinea,$this->acciontipo->id]);
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
            $this->precioventa=$this->precioventa_ud * $this->ancho * $this->alto * $this->unidades ;
        }else{
            $this->precioventa=$this->precioventa_ud * $this->ancho * $this->alto * $this->unidades * ($this->factor + $this->merma);
        }
        $this->precioventa=round($this->precioventa,2);
    }

    public function recalculoPrecioVenta($presupacciondetalle)
    {
        if($presupacciondetalle->acciontipo_id!='1'){
            $presupacciondetalle->precioventa=$presupacciondetalle->precioventa_ud * $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades ;
        }else{
            $presupacciondetalle->precioventa=$presupacciondetalle->precioventa_ud * $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * ($presupacciondetalle->factor + $presupacciondetalle->merma);
        }
        $presupacciondetalle->precioventa=round($presupacciondetalle->precioventa,2);
        $presupacciondetalle->save();
        $this->dispatchBrowserEvent('notify', 'Precio venta actualizado.');

        $this->recalcular($presupacciondetalle);
        $this->actualizaPartida();


        // $this->save($presupacciondetalle);
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
