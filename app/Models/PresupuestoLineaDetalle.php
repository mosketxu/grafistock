<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestoLineaDetalle extends Model
{
    use HasFactory;

    protected $fillable= ['presupuesto_id','producto_id','visible','orden','descripcion','preciocoste','precioventa','ratio','unidades','ruta','fichero','observaciones'];

    public function presupuestolinea()
    {
        return $this->belongsTo(PresupuestoLinea::class);
    }

}
