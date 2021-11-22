<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Presupuesto extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'fechapresupuesto' => 'date:Y-m-d',
    // ];


    protected $fillable=['presupuesto','descripcion','entidad_id','solicitante_id','fechapresupuesto','precioventa','preciotarifa','ratio','unidades','iva','ruta','fichero','estado','observaciones'];

    public function presupuestolineas()
    {
        return $this->hasMany(PresupuestoLinea::class)->orderBy('orden');
    }

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function solicitante()
    {
        return $this->belongsTo(User::class,'solicitante_id','id');
    }

    public function recalculo()
    {
        $this->precioventa=$this->presupuestolineas->sum('precioventa');
        $this->preciotarifa=$this->presupuestolineas->sum('preciotarifa');
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
