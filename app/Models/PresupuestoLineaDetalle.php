<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestoLineaDetalle extends Model
{
    use HasFactory;

    protected $fillable= ['presupuestolinea_id','acciontipo_id','accionproducto_id','entidad_id','visible','orden','descripcion',
    'preciocoste_ud','preciocoste','precioventa_ud','precioventa','udpreciocoste_id','factor','merma','aux','unidades','metros2','ancho','alto','ruta','fichero','observaciones'];

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

    public function unidadpreciocoste()
    {
        return $this->belongsTo(UnidadCoste::class,'udpreciocoste_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Entidad::class,'entidad_id');
    }

}
