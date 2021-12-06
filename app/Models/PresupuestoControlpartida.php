<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestoControlpartida extends Model
{
    use HasFactory;

    protected $table = 'presupuesto_controlpartidas';

    protected $fillable = ['presupuesto_id','acciontipo_id','activo','contador'];

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class,'presupuesto_id');
    }

    public function acciontipo()
    {
        return $this->belongsTo(AccionTipo::class,'acciontipo_id');
    }
}
