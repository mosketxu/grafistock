<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestoLineaDetalle extends Model
{
    use HasFactory;

    protected $fillable= ['presupuestolinea_id','acciontipo_id','accionproducto_id','visible','orden','descripcion','preciotarifa','preciotarifa_ud','precioventa','udpreciotarifa_id','factor','merma','aux','unidades','metros2','ancho','alto','ruta','fichero','observaciones'];

    public function presupuestolinea()
    {
        return $this->belongsTo(PresupuestoLinea::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class,'accionproducto_id');
    }

    public function accion()
    {
        return $this->belongsTo(Accion::class,'accionproducto_id');
    }

    public function acciontipo()
    {
        return $this->belongsTo(AccionTipo::class,'acciontipo_id');
    }

    public function unidadpreciotarifa()
    {
        return $this->belongsTo(Unidad::class,'udpreciotarifa_id');
    }

}
