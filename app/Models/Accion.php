<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;

    protected $table = 'acciones';
    protected $fillable=['referencia','descripcion','acciontipo_id','preciocoste','ud_id','precioventa','observaciones'];

    public function prespuestolineadetalle(){return $this->hasMany(PresupuestoLineaDetalle::class,'accion_id');}
    public function acciontipo(){return $this->belongsTo(AccionTipo::class,'acciontipo_id');}


}
