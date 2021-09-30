<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestoLinea extends Model
{
    use HasFactory;


    protected $fillable=['presupuesto_id','visible','orden','descripcion','preciocoste','precioventa','ratio','unidades','ruta','fichero','observaciones'];

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }

    public function presupuestolineadetalles()
    {
        return $this->hasMany(PresupuestoLineaDetalle::class)->orderBy('orden');
    }

}
