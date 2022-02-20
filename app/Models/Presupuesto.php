<?php

namespace App\Models;

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

    public function presupuestolineas()
    {
        return $this->hasMany(PresupuestoLinea::class)->orderBy('orden');
    }

    public function contacto()
    {
        return $this->belongsTo(EntidadContacto::class,'entidadcontacto_id')->withDefault();
    }

    public function detalles()
    {
        return $this->hasManyThrough(
            PresupuestoLineaDetalle::class,
            PresupuestoLinea::class,
            'presupuesto_id', // Foreign key on the PresupuestoLinea table...
            'presupuestolinea_id', // Foreign key on the PresupuestoLineaDetalle table...
            'id', // Local key on the Presupuestos table...
            'id' // Local key on the presupuestolinea table...
        );

    }

    public function presupuestolineasvisibles()
    {
        return $this->hasMany(PresupuestoLinea::class)->where('visible',true)->orderBy('orden');
    }

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function solicitante()
    {
        return $this->belongsTo(User::class,'solicitante_id','id');
    }

    public function presupuestocontrolpartidas()
    {
        return $this->hasMany(PresupuestoControlpartida::class,'presupuesto_id');
    }

    public function recalculo()
    {
        $this->precioventa=$this->presupuestolineas->sum('precioventa')*(1+ $this->incremento/100);
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



}
