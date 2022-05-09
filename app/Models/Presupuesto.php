<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presupuesto extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $casts = [
    //     'fechapresupuesto' => 'date:Y-m-d',
    // ];
    protected $dates = ['deleted_at'];


    protected $fillable=['presupuesto','descripcion','entidad_id','entidadcontacto_id','solicitante_id','fechapresupuesto','refgrafitex','refcliente','precioventa','preciocoste','unidades','incremento','iva','ruta','fichero','estado','observaciones'];

    public function presupuestolineas(){return $this->hasMany(PresupuestoLinea::class)->orderBy('orden');}
    public function contacto(){return $this->belongsTo(EntidadContacto::class,'entidadcontacto_id')->withDefault();}
    public function entidad(){return $this->belongsTo(Entidad::class);}
    public function solicitante(){return $this->belongsTo(User::class,'solicitante_id','id');}
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


    public function recalculo()
    {
        $this->precioventa=$this->presupuestolineas->sum('precioventa');
        $this->preciocoste=$this->presupuestolineas->sum('preciocoste');
        $this->save();
    }

    public function getFechapresuAttribute()
    {
        return Carbon::parse($this->fechapresupuesto)->format('d-m-Y');
    }

    public function getStatusColorAttribute()
    {
        return [
            '0'=>['gray','En curso'],
            '1'=>['green','Aceptado'],
            '2'=>['red','Rechazado']
        ][$this->estado] ?? ['gray',''];
    }


    public function getRutaficheroAttribute()
    {
        return $this->ruta.'/'.$this->fichero;
    }

    public function scopeImprimirPresupuesto()
    {
        $presupuesto=Presupuesto::with('entidad')
        ->with('presupuestodetalles')
        ->find($this->id);

        $base=$presupuesto->presupuestodetalles->sum('base');


        $pdf = \PDF::loadView('presupuesto.presupuestopdf', compact(['presupuesto','base']));

        Storage::put('public/'.$presupuesto->ruta.'/'.$presupuesto->fichero, $pdf->output());

        return $pdf->download($presupuesto->fichero);
    }

    public function scopeFiltrosPresupuestos(Builder $query, $entidad, $comercial, $estado,$fini,$ffin,$vini,$vfin) : Builder
    {
        return $query->when($entidad!='', function ($query) use($entidad){
            $query->where('entidad_id',$entidad);
        })
        ->when($comercial!='', function ($query) use($comercial){
            $query->where('solicitante_id',$comercial);
        })
        ->when($estado!='', function ($query) use($estado){
            $query->where('presupuestos.estado',$estado);
        })
        //fechas
        ->when($fini && !$ffin, function ($query) use($fini){
            $query->where('fechapresupuesto','>=', $fini.'-01');
        })
        ->when(!$fini && $ffin, function ($query) use($ffin){
            $query->where('fechapresupuesto','<=', $ffin.'-31');
        })
        ->when($fini && $ffin, function ($query) use($fini,$ffin){
            $fi=$fini.'-01';
            $ff=$ffin.'-'. cal_days_in_month(CAL_GREGORIAN, substr($ffin, -2), substr($ffin, 4));
            $query->whereBetween('fechapresupuesto', [$fi, $ff]);
        })
        //ventas
        // ->when($vini && !$vfin, function ($query) use($vini){
        //     $query->where('precioventa','>=', $vini);
        // })
        // ->when(!$vini && $vfin, function ($query) use($vfin){
        //     $query->where('precioventa','<=', $vfin);
        // })
        // ->when($vini && $vfin, function ($query) use($vini,$vfin){
        //     $query->whereBetween('precioventa', [$vini, $vfin]);
        // })
        ;
    }


}
