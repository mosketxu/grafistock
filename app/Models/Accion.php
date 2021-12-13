<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;

    protected $table = 'acciones';
    protected $fillable=['referencia','descripcion','acciontipo_id','preciotarifa','udpreciotarifa_id','precioventa','porcentaje','porcentajemin','observaciones'];

    public function prespuestolineadetalle(){return $this->hasMany(PresupuestoLineaDetalle::class,'accionproducto_id');}
    public function acciontipo(){return $this->belongsTo(AccionTipo::class,'acciontipo_id');}
    public function unidadpreciotarifa(){return $this->belongsTo(ProductoUnidadcoste::class,'udpreciotarifa_id');}


}
