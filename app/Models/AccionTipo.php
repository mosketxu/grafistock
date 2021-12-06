<?php

namespace App\Models;

use App\Http\Controllers\PresupuestoController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccionTipo extends Model
{
    use HasFactory;
    protected $fillable=['nombre','nombrecorto'];

    public function acciones()
    {
        return $this->hasMany(Accion::class);
    }

    public function presupuestocontrolpartidas()
    {
        return $this->hasMany(PresupuestoControlpartida::class,'acciontipo_id');
    }
}
