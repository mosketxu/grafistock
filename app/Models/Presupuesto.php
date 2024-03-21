<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Presupuesto extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $casts = ['fechapresupuesto' => 'date:Y-m-d',];
    protected $dates = ['deleted_at'];


    protected $fillable=['presupuesto','descripcion','entidad_id','entidadcontacto_id','solicitante_id','fechapresupuesto','haypedidominimo','refgrafitex','refcliente','precioventa','preciocoste','unidades','incremento','iva','ruta','fichero','estado','observaciones'];

    public function presupuestolineas(){return $this->hasMany(PresupuestoLinea::class)->orderBy('orden');}
    public function contacto(){return $this->belongsTo(EntidadContacto::class,'entidadcontacto_id')->withDefault();}
    // public function entidad(){return $this->belongsTo(Entidad::class);}
    public function ent(){return $this->belongsTo(Entidad::class,'entidad_id','id');}
    public function solicitante(){return $this->belongsTo(User::class,'solicitante_id','id')->withDefault('');}
    public function presupuestocontrolpartidas(){return $this->hasMany(PresupuestoControlpartida::class,'presupuesto_id');}

    public function presupuestolineasvisibles(){return $this->hasMany(PresupuestoLinea::class)->where('visible',true)->orderBy('orden');}

    public function detalles(){
        return $this->hasManyThrough(
            PresupuestoLineaDetalle::class,
            PresupuestoLinea::class,
            'presupuesto_id', // Foreign key on the PresupuestoLinea table...
            'presupuestolinea_id', // Foreign key on the PresupuestoLineaDetalle table...
            'id', // Local key on the Presupuestos table...
            'id' // Local key on the presupuestolinea table...
        );
    }

    public function pminimo(){
        $productopedidominimo=Producto::where('descripcion','Pedido Mínimo')->first()->id;
        return $this->hasManyThrough(
            PresupuestoLineaDetalle::class,
            PresupuestoLinea::class,
            'presupuesto_id', // Foreign key on the PresupuestoLinea table...
            'presupuestolinea_id', // Foreign key on the PresupuestoLineaDetalle table...
            'id', // Local key on the Presupuestos table...
            'id' // Local key on the presupuestolinea table...
        )->where('accionproducto_id',$productopedidominimo);
    }

    public function recalculo(){
        $this->precioventa=$this->presupuestolineas->sum('precioventa');
        $this->preciocoste=$this->presupuestolineas->sum('preciocoste');
        $this->save();
    }

    public function getFechapresuAttribute(){
        return Carbon::parse($this->fechapresupuesto)->format('d-m-Y');
    }

    public function getStatusColorAttribute(){
        return [
            '0'=>['gray','En curso'],
            '1'=>['green','Aceptado'],
            '2'=>['red','Rechazado']
        ][$this->estado] ?? ['gray',''];
    }

    public function getRutaficheroAttribute(){
        return $this->ruta.'/'.$this->fichero;
    }

    public function scopeImprimirPresupuesto(){
        $presupuesto=Presupuesto::with('ent')
            ->with('presupuestodetalles')
            ->find($this->id);
        $base=$presupuesto->presupuestodetalles->sum('base');
        $pdf = \PDF::loadView('presupuesto.presupuestopdf', compact(['presupuesto','base']));
        Storage::put('public/'.$presupuesto->ruta.'/'.$presupuesto->fichero, $pdf->output());

        return $pdf->download($presupuesto->fichero);
    }

    public static function presupuestos($mes,$filtroentidad,$filtrosolicitante,$filtroestado,$filtroFi,$filtroFf,$filtroventasIni,$filtroventasFin,$ccliente,$ccomercial){
        $com= $ccomercial=='1'? 'entidad': '';
        $ent = $ccliente=='1' ? 'comercial' : '';

        return Presupuesto::query()
            ->join('entidades','entidades.id','presupuestos.entidad_id')
            ->join('users','users.id','presupuestos.solicitante_id')
            ->select('entidades.entidad as entidad','users.name as comercial','presupuestos.estado as estado',
                DB::raw('(CASE WHEN presupuestos.estado = ' . 1 . ' THEN "Aceptado" WHEN presupuestos.estado='. 0 .' then "En Curso" ELSE "Rechazado" END) AS status'))
            ->selectRaw('count(presupuestos.id) as numpresups')
            ->selectRaw('sum(presupuestos.precioventa - presupuestos.preciocoste ) as margenbruto')
            ->selectRaw('sum(presupuestos.precioventa) as ventas')
            ->filtrosPresupuestos($filtroentidad,$filtrosolicitante,$filtroestado,$filtroFi,$filtroFf,$filtroventasIni,$filtroventasFin)
            ->groupBy('entidad','presupuestos.estado','comercial')
            ->get();
    }

    public static function presupuestosXLS($mes,$filtroentidad,$filtrosolicitante,$filtroestado,$filtroFi,$filtroFf,$filtroventasIni,$filtroventasFin){
        if($mes!=true)
            return Presupuesto::query()
            ->join('entidades','entidades.id','presupuestos.entidad_id')
            ->join('users','users.id','presupuestos.solicitante_id')
            ->select('entidades.entidad as entidad','users.name as comercial',
                DB::raw('(CASE WHEN presupuestos.estado = ' . 1 . ' THEN "Aceptado" WHEN presupuestos.estado='. 0 .' then "En Curso" ELSE "Rechazado" END) AS status'))
            ->selectRaw('count(presupuestos.id) as numpresups')
            ->selectRaw('sum(presupuestos.precioventa - presupuestos.preciocoste ) as margenbruto')
            ->selectRaw('sum(presupuestos.precioventa) as ventas')
            ->filtrosPresupuestos($filtroentidad,$filtrosolicitante,$filtroestado,$filtroFi,$filtroFf,$filtroventasIni,$filtroventasFin,$filtropedidominimo)
            ->groupBy('entidad','presupuestos.estado','comercial')
            ->get();
        else
            return Presupuesto::query()
            ->join('entidades','entidades.id','presupuestos.entidad_id')
            ->join('users','users.id','presupuestos.solicitante_id')
            ->select('entidades.entidad as entidad','users.name as comercial',
                DB::raw('(CASE WHEN presupuestos.estado = ' . 1 . ' THEN "Aceptado" WHEN presupuestos.estado='. 0 .' then "En Curso" ELSE "Rechazado" END) AS status'),
                DB::raw("(DATE_FORMAT(fechapresupuesto, '%m-%Y')) as month_year"))
            ->selectRaw('count(presupuestos.id) as numpresups')
            ->selectRaw('sum(presupuestos.precioventa - presupuestos.preciocoste ) as margenbruto')
            ->selectRaw('sum(presupuestos.precioventa) as ventas')
            ->filtrosPresupuestos($filtroentidad,$filtrosolicitante,$filtroestado,$filtroFi,$filtroFf,$filtroventasIni,$filtroventasFin,$filtropedidominimo)
            ->groupBy('entidad','presupuestos.estado','comercial',DB::raw("DATE_FORMAT(fechapresupuesto, '%m-%Y')"))
            ->get();
    }

    public static function presupuestossinagruparXLS($mes,$filtroentidad,$filtrosolicitante,$filtroestado,$filtroFi,$filtroFf,$filtroventasIni,$filtroventasFin){
        return Presupuesto::query()
        ->with('pminimo')
        ->join('entidades','entidades.id','presupuestos.entidad_id')
        ->join('users','users.id','presupuestos.solicitante_id')
        ->select('entidades.entidad as entidad','users.name as comercial',
            'presupuestos.presupuesto','presupuestos.fechapresupuesto','presupuestos.preciocoste','presupuestos.precioventa',
            DB::raw('presupuestos.precioventa- presupuestos.preciocoste as margen'),
            DB::raw('(presupuestos.precioventa- presupuestos.preciocoste) / presupuestos.precioventa as porcentajemargen'),
            DB::raw('(CASE WHEN presupuestos.estado = ' . 1 . ' THEN "Aceptado" WHEN presupuestos.estado='. 0 .' then "En Curso" ELSE "Rechazado" END) AS status'))
        ->filtrosPresupuestos($filtroentidad,$filtrosolicitante,$filtroestado,$filtroFi,$filtroFf,$filtroventasIni,$filtroventasFin,$filtropedidominimo)
        ->get();
    }

    public function scopeFiltrosPresupuestos(Builder $query, $entidad, $comercial, $estado,$fini,$ffin,$vini,$vfin) : Builder{
        return $query
            ->when($entidad!='', function ($query) use($entidad){$query->where('entidad_id',$entidad);})
            ->when($comercial!='', function ($query) use($comercial){$query->where('solicitante_id',$comercial);})
            ->when($estado!='', function ($query) use($estado){$query->where('presupuestos.estado',$estado);})
            ->when($fini && !$ffin, function ($query) use($fini){$query->where('fechapresupuesto','>=', $fini);})
            ->when(!$fini && $ffin, function ($query) use($ffin){$query->where('fechapresupuesto','<=', $ffin);})
            ->when($fini && $ffin, function ($query) use($fini,$ffin){$query->whereBetween('fechapresupuesto', [$fini, $ffin]);})
        ;
    }
}
