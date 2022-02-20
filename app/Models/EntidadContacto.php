<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadContacto extends Model
{
    use HasFactory;

    protected $fillable=['entidad_id','contacto','cargo','movil','telefono','email'];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class);
    }


}

