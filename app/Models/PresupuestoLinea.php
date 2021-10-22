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
        return $this->hasMany(PresupuestoLineaDetalle::class,'presupuestolinea_id')->orderBy('orden');
    }

    public function recalculo()
    {
        $this->precioventa=$this->presupuestolineadetalles->sum('precioventa');
        $this->preciocoste=$this->presupuestolineadetalles->sum('preciocoste');
        $this->save();
    }


}
