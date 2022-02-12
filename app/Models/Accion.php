<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;

    protected $table = 'acciones';
    protected $fillable=['referencia','descripcion','acciontipo_id','preciocoste','precioventa','precioventa2','precioventa3','precioventa4','preciominimo','udpreciocoste_id','observaciones'];

    public function prespuestolineadetalle(){return $this->hasMany(PresupuestoLineaDetalle::class,'accionproducto_id');}
    public function acciontipo(){return $this->belongsTo(AccionTipo::class,'acciontipo_id');}
    public function unidadpreciocoste(){return $this->belongsTo(UnidadCoste::class,'udpreciocoste_id');}


}
