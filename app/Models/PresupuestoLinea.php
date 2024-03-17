<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestoLinea extends Model
{
    use HasFactory;


    protected $fillable=['presupuesto_id','visible','orden','descripcion','preciocoste','precioventa','factor','unidades','ruta','fichero','observaciones'];

    public function presupuesto(){return $this->belongsTo(Presupuesto::class);}
    public function presupuestolineadetalles(){return $this->hasMany(PresupuestoLineaDetalle::class,'presupuestolinea_id')->orderBy('orden');}
    public function presupuestolineadetallesportipo(){return $this->hasMany(PresupuestoLineaDetalle::class,'presupuestolinea_id')->orderBy('acciontipo_id')->orderBy('orden');}
    public function pminimo(){
        return $this->hasMany(PresupuestoLineaDetalle::class,'presupuestolinea_id')->where('accionproducto_id','1056');
    }


    public function recalculo(){
        $incremento=$this->presupuesto->incremento;
        $this->precioventa=$this->presupuestolineadetalles->sum('precioventa')*(1+ $incremento/100);;
        $this->preciocoste=$this->presupuestolineadetalles->sum('preciocoste');
        $this->save();
    }
}
