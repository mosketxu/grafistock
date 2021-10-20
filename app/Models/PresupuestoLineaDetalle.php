<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestoLineaDetalle extends Model
{
    use HasFactory;

    protected $fillable= ['presupuestolinea_id','acciontipo_id','accion_id','visible','orden','descripcion','preciocoste','precioventa','ratio','unidades','ruta','fichero','observaciones'];

    public function presupuestolinea()
    {
        return $this->belongsTo(PresupuestoLinea::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function accion()
    {
        return $this->belongsTo(Accion::class);
    }

}
