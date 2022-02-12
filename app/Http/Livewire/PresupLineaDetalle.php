<?php

namespace App\Http\Livewire;

use App\Models\{Producto,Accion,AccionTipo, EmpresaTipo, Entidad, PresupuestoControlpartida, PresupuestoLinea,PresupuestoLineaDetalle, ProductoFamilia, UnidadCoste};
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class PresupLineaDetalle extends Component
{
    // Vbles filtros
    public $search='';public $filtrofamilia='';public $filtrotipo='';public $filtromaterial='';public $filtroclipro='';public $filtroacabado='';public $filtrodescripcion='';

    // Vbles apoyo
    public $message;public $showEdit=true;public $acciontipoId;public $presuplinea;public $presupuestolinea_id;public $presupuestolinea;public $presupuestolineadetalleId='';
    public $accionproducto;public $showAnchoAlto=false;public $showMinutos=false;public $controlpartidas;public $deshabilitadoPVenta='';public $deshabilitadoPCoste='disabled';
    public $colorfondoCoste='';public $colorfondoVenta='';public $descrip='';

    public AccionTipo $acciontipo;
    public $empresaTipo;

    // vbles modelo
    public $visible=true;public $orden=1;public $pldetalleId='';public $descripcion;public $proveedor_id;public $empresatipo_id;
    public $preciocoste_ud=0;public $preciocoste=0;public $udpreciocoste_id;
    public $precioventa_ud=0;public $preciominimo=0;public $unidadventa='';
    public $factor=1;public $factormin=1;public $merma=0;
    public $ancho=1;public $alto=1;
    public $unidades=1;public $minutos=1;
    public $accionproducto_id;public $observaciones;

    protected $rules = [
        'visible'=>'','orden'=>'nullable|numeric','proveedor_id'=>'nullable|numeric',
        'preciocoste_ud'=>'numeric','precioventa_ud'=>'numeric',
        'ancho'=>'numeric','alto'=>'numeric',
        'factor'=>'numeric','merma'=>'numeric',
        'unidades'=>'numeric','minutos'=>'numeric',
        'accionproducto_id'=>'required',
    ];

    protected $listeners = [ 'presuplineadetallerefresh' => '$refresh'];

    public function mount(PresupuestoLinea $presupuestolinea)
    {
        $this->presuplinea=$presupuestolinea;
        $this->empresaTipo=$presupuestolinea->presupuesto->entidad->empresatipo;
        $this->empresatipo_id=$this->empresaTipo->id;
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
        $proveedores='';$materiales='';$acabados='';$tipos='';
        $empresatipos='';
        $familias=ProductoFamilia::where('id','<>','16')->orderBy('nombre')->get();
        if($this->acciontipo->nombrecorto=='EXT'){
            $proveedores=Entidad::whereIn('entidadtipo_id', ['2', '3'])->where('presupuesto',true)->orderBy('entidad')->get();
        }

        $presupacciones=PresupuestoLineaDetalle::where('presupuestolinea_id',$this->presuplinea->id)->where('acciontipo_id',$this->acciontipoId)->orderBy('orden')->get();
        $this->tituloaccion=$this->acciontipo->nombre;

        if($this->acciontipo->nombrecorto!='MAT' && $this->acciontipo->nombrecorto!='EMB'){
            $acciones=Accion::where('acciontipo_id',$this->acciontipoId)->orderBy('descripcion')->get();
            $empresatipos=EmpresaTipo::get();
        }else{
            if($this->acciontipo->nombrecorto=='MAT'){
                $proveedores=Entidad::orderBy('entidad')->has('productos')->get();
                $materiales= Producto::query()
                    ->join('producto_materiales','producto_materiales.id','=','productos.material_id')
                    ->select('producto_materiales.id', 'producto_materiales.nombre')
                    ->groupBy('material_id')
                    ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
                    ->when($this->filtrofamilia!='', function ($query){$query->where('familia_id',$this->filtrofamilia);})
                    ->when($this->filtroacabado!='', function ($query){$query->where('acabado_id',$this->filtroacabado);})
                    ->when($this->filtrotipo!='', function ($query){$query->where('tipo_id',$this->filtrotipo);})
                    ->orderBy('producto_materiales.nombre')
                    ->get();
                $familias= Producto::query()
                    ->join('producto_familias','producto_familias.id','=','productos.familia_id')
                    ->select('producto_familias.id', 'producto_familias.nombre')
                    ->groupBy('familia_id')
                    ->where('producto_familias.id','<>','16') // familia 16  es empaquetado
                    ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
                    ->when($this->filtromaterial!='', function ($query){$query->where('material_id',$this->filtromaterial);})
                    ->when($this->filtroacabado!='', function ($query){$query->where('acabado_id',$this->filtroacabado);})
                    ->when($this->filtrotipo!='', function ($query){$query->where('tipo_id',$this->filtrotipo);})
                    ->orderBy('producto_familias.nombre')
                    ->get();
                $acabados= Producto::query()
                    ->join('producto_acabados','producto_acabados.id','=','productos.acabado_id')
                    ->select('producto_acabados.id', 'producto_acabados.nombre')
                    ->groupBy('acabado_id')
                    ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
                    ->when($this->filtromaterial!='', function ($query){$query->where('material_id',$this->filtromaterial);})
                    ->when($this->filtrofamilia!='', function ($query){$query->where('familia_id',$this->filtrofamilia);})
                    ->when($this->filtrotipo!='', function ($query){$query->where('tipo_id',$this->filtrotipo);})
                    ->orderBy('producto_acabados.nombre')
                    ->get();
                $tipos= Producto::query()
                    ->join('producto_tipos','producto_tipos.id','=','productos.tipo_id')
                    ->select('producto_tipos.id', 'producto_tipos.nombre')
                    ->groupBy('tipo_id')
                    ->when($this->filtroclipro!='', function ($query){$query->where('entidad_id',$this->filtroclipro);})
                    ->when($this->filtromaterial!='', function ($query){$query->where('material_id',$this->filtromaterial);})
                    ->when($this->filtroacabado!='', function ($query){$query->where('acabado_id',$this->filtroacabado);})
                    ->when($this->filtrofamilia!='', function ($query){$query->where('familia_id',$this->filtrofamilia);})
                    ->orderBy('producto_tipos.nombre')
                    ->get();
                $acciones=Producto::query()
                    ->with('entidad','material','acabado','tipo')
                    ->search('referencia',$this->search)
                    ->orSearch('descripcion',$this->search)
                    ->when($this->filtrofamilia!='', function ($query){
                        $query->where('familia_id',$this->filtrofamilia);
                        })
                    ->when($this->filtromaterial!='', function ($query){
                        $query->where('material_id',$this->filtromaterial);
                        })
                    ->when($this->filtroclipro!='', function ($query){
                        $query->where('entidad_id',$this->filtroclipro);
                        })
                    ->when($this->filtroacabado!='', function ($query){
                        $query->where('acabado_id',$this->filtroacabado);
                        })
                    ->when($this->filtrotipo!='', function ($query){
                        $query->where('tipo_id',$this->filtrotipo);
                        })
                    ->orderBy('referencia','asc')
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

        return view('livewire.presup-linea-detalle',compact('acciones','presupacciones','familias','proveedores','unidadesventa','tipos','acabados','familias','materiales','empresatipos'));
    }

    public function edit(PresupuestoLineaDetalle $presupuestoaccion)
    {
        $this->presupuestolinea_id=$presupuestoaccion->id;
        $this->acciontipo_id=$presupuestoaccion->acciontipo_id;
        $this->accionproducto_id=$presupuestoaccion->accionproducto_id;
        $this->entidad_id=$presupuestoaccion->entidad_id;
        $this->empresatipo_id=$presupuestoaccion->empresatipo_id;
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

        $this->empresaTipo=EmpresaTipo::find($this->empresatipo_id);

        $ud=$presupuestoaccion->unidadpreciocoste->nombrecorto ?? '';
        $this->showAnchoAlto= $ud=='e_m2' ? true : false;
        $this->showMinutos= $ud=='e_min' ? true : false;

        $condiciones=['IMP','ACA','MAN','TRA'];
        $this->deshabilitadoPCoste='';
        $this->colorfondoPCoste='';
        $this->acciontipo=AccionTipo::find($this->acciontipo_id);
        if(in_array($this->acciontipo->nombrecorto, $condiciones)){
            $this->deshabilitadoPCoste='disabled';
            $this->colorfondoPCoste='bg-gray-100';
        }
    }

    public function replicateRow(PresupuestoLineaDetalle $lineadetalle)
    {
        $lineadetalle->clonarlinea();
        $this->dispatchBrowserEvent('notify', 'Linea copiada!');
        $this->emit('presuplineadetallerefresh');
    }

    public function UpdatedAccionproductoId()
    {
        $this->merma=0;
        $this->factor=1;
        $this->factormin=1;
        $this->preciocoste_ud=0;
        $this->precioventa_ud=0;
        $this->preciominimo=0;
        $this->udpreciocoste_id='';
        $this->unidadventa='';
        if($this->accionproducto_id!=''){
            // si no es material ni embalaje
            if($this->acciontipo->nombrecorto!='MAT' && $this->acciontipo->nombrecorto!='EMB'){
                $this->accionproducto=Accion::find($this->accionproducto_id);
                $this->preciocoste_ud=$this->accionproducto->preciocoste;
                $this->precioventa_ud=$this->accionproducto->precioventa;
                $this->preciominimo=$this->accionproducto->preciominimo;
                $this->udpreciocoste_id=$this->accionproducto->udpreciocoste_id;
                $this->unidadventa=$this->accionproducto->unidadpreciocoste->nombrecorto ?? '';
                $this->descrip=$this->accionproducto->descripcion;
                if($this->descrip==' Genérico' || $this->acciontipo->nombrecorto=='PFM'){
                    $this->deshabilitadoPCoste='';
                    $this->colorfondoCoste='';
                }
            }else{ //es material o embalaje
                $this->accionproducto=Producto::find($this->accionproducto_id);
                $this->descrip=$this->accionproducto->descripcion;
                if ($this->descrip!=' Genérico') {
                    $this->preciocoste_ud=$this->accionproducto->preciocoste;
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

    public function UpdatedEmpresatipoId(){
        $this->empresaTipo=EmpresaTipo::find($this->empresatipo_id);
    }

    public function UpdatedUdpreciocosteId(){
        $this->showAnchoAlto= UnidadCoste::find($this->udpreciocoste_id)->nombrecorto=='e_m2' ? true : false;
        $this->showMinutos= UnidadCoste::find($this->udpreciocoste_id)->nombrecorto=='e_min' ? true : false;
    }

    public function UpdatedUnidades(){
        if (!$this->unidades) $this->unidades=0;
        $this->validate(['unidades'=>'numeric',]);
        $this->calculoPrecioVenta();}

    public function UpdatedMinutos(){
        if(!$this->unidades) $this->unidades=0;
        $this->validate(['minutos'=>'numeric',]);
        $this->calculoPrecioVenta();}

    public function UpdatedAncho(){
        if(!$this->ancho) $this->ancho=1;
        $this->validate(['ancho'=>'numeric',]);
        $this->calculoPrecioVenta();}

    public function UpdatedAlto(){
        if(!$this->alto) $this->alto=1;
        $this->validate(['alto'=>'numeric',]);
        $this->calculoPrecioVenta();}

    // con el factor tenemos en cuenta el minimo
    public function UpdatedFactor(){
        if(!$this->factor) $this->factor=1;
        $this->validate(['factor'=>'numeric',]);
        if($this->factor<$this->factormin){
            $this->factor=$this->factormin;
        }
        $this->precioventa_ud=round($this->preciocoste_ud * $this->factor,2);
        $this->calculoPrecioVenta();
    }

    // con la merma tenemos en cuenta el minimo
    public function UpdatedMerma(){
        if(!$this->merma) $this->merma=0;
        $this->validate(['merma'=>'numeric']);
        $this->calculoPrecioVenta();
    }

    // con el precio de venta tenemos en cuenta el minimo
    public function UpdatedPreciocosteUd(){
        if(!$this->preciocoste_ud) $this->preciocoste_ud=0;
        if($this->preciominimo=='0' || $this->preciocoste_ud<$this->preciominimo)
            $this->preciominimo=$this->preciocoste_ud;
        $this->validate(['preciocoste_ud'=>'numeric']);
        $this->calculoPrecioVenta();
    }

    public function UpdatedPrecioventaUd(){
        if(!$this->precioventa_ud) $this->precioventa_ud=0;
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
        if(!$unidades) $unidades=1;
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
        $presupaccion->update([
            'factor'=>$factor,
            'precioventa_ud'=>round($presupaccion->preciocoste_ud * $factor,2)
        ]);

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
        $presupaccion->update(['merma'=>$merma,]);
        $this->recalculoPrecioVenta($presupaccion);
        $this->dispatchBrowserEvent('notify', 'Merma y Precio Venta Actualizados.');
    }

    public function save()
    {
        $this->validate();
        if($this->accionproducto_id){
            if(!$this->udpreciocoste_id) $this->udpreciocoste_id='2';
            $this->validate();

            $pldetalle = PresupuestoLineaDetalle::updateOrCreate(['id'=>$this->presupuestolinea_id], [
                'presupuestolinea_id'=>$this->presuplinea->id,
                'acciontipo_id'=>$this->acciontipoId,
                'accionproducto_id'=>$this->accionproducto_id,
                'empresatipo_id'=>$this->empresatipo_id,
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
        // si no es material la merma es 0 así que el cálculo es el mismo.
        $this->preciocoste=$this->ancho * $this->alto * $this->unidades * $this->minutos * $this->preciocoste_ud  ;
        $this->precioventa=$this->ancho * $this->alto * $this->unidades * $this->minutos * ($this->precioventa_ud  + $this->preciocoste_ud*$this->merma);

        // if($this->acciontipoId!='1'){ // No es material
        //     $this->precioventa=$this->ancho * $this->alto * $this->unidades * $this->minutos * $this->precioventa_ud;
        // }else{ // Es material
        //     $this->precioventa=$this->ancho * $this->alto * $this->unidades * $this->minutos * ($this->precioventa_ud  + $this->preciocoste_ud*$this->merma);
        // }
        $this->preciocoste=round($this->preciocoste,2);
        $this->precioventa=round($this->precioventa,2);
    }

    public function recalculoPrecioVenta($presupacciondetalle)
    {
        // si no es material la merma es 0 así que el cálculo es el mismo.
        $presupacciondetalle->preciocoste= $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * $presupacciondetalle->minutos * $presupacciondetalle->preciocoste_ud  ;
        $presupacciondetalle->precioventa= $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * $presupacciondetalle->minutos * ($presupacciondetalle->precioventa_ud  + $presupacciondetalle->preciocoste_ud *$presupacciondetalle->merma);

        // if($presupacciondetalle->acciontipo_id!='1'){
        //     $presupacciondetalle->precioventa= $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * $presupacciondetalle->minutos * $presupacciondetalle->precioventa_ud ;
        // }else{
        //     $presupacciondetalle->precioventa= $presupacciondetalle->ancho * $presupacciondetalle->alto * $presupacciondetalle->unidades * $presupacciondetalle->minutos * ($presupacciondetalle->precioventa_ud  + $presupacciondetalle->preciocoste_ud *$presupacciondetalle->merma);
        // }
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
