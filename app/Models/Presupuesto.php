<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;

    protected $casts = [
        'fechapresupuesto' => 'date:Y-m-d',
    ];

    protected $fillable=['presupuesto','entidad_id','fechapresupuesto','precioventa','ratio','unidades','iva','ruta','fichero','estado','observaciones'];

    public function prespuestolineas()
    {
        return $this->hasMany(PresupuestoLinea::class)->orderBy('orden');
    }

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }

}
