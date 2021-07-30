<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    use HasFactory;
    protected $table = 'productos';
    protected $fillable=['referencia','descripcion','tipo_id','material_id','grosor_mm','ancho','udancho_id','alto','udalto_id','acabado_id','grupoproduccion_id','clase_id','calidad_id','udsolicitud_id','costeprov',
        'udcoste_id','costegrafitex','udproducto_id','entidad_id','caja_id','costecaja','fichaproducto','observaciones','ref_optimus','refprov_optimus'];


    public function entidad(){return $this->belongsTo(Entidad::class);}

    public function ubicacion(){return $this->belongsTo(Ubicacion::class,'ubicacion_id','id');}

    public function material(){return $this->belongsTo(ProductoMaterial::class);}

    public function acabado(){return $this->belongsTo(ProductoAcabado::class,'acabado_id','id');}

    public function calidad(){return $this->belongsTo(ProductoCalidad::class,'calidad_id','id');}

    public function clase(){return $this->belongsTo(ProductoClase::class,'clase_id','id');}

    public function grupoproduccion(){return $this->belongsTo(ProductoGrupoproduccion::class,'grupoproduccion_id','id');}

    public function tipo(){return $this->belongsTo(ProductoTipo::class,'tipo_id','id');}

    public function unidadsolicitud(){return $this->belongsTo(Unidad::class,'udsolicitud_id','id');}

    public function unidadancho(){return $this->belongsTo(Unidad::class,'udancho_id','id');}

    public function unidadalto(){return $this->belongsTo(Unidad::class,'udalto_id','id');}

    public function unidadproducto(){return $this->belongsTo(Unidad::class,'udproducto_id','id');}

    public function unidadcoste(){return $this->belongsTo(ProductoUnidadcoste::class,'udcoste_id','id');}

    public function caja(){return $this->belongsTo(ProductoCaja::class,'caja_id','id');}

    public function movimientos(){return $this->belongsTo(StockMovimiento::class);}

    public function pedidodetalle(){return $this->belongsTo(PedidoDetalle::class,'producto_id');}

    public function pedidodetalles(){return $this->hasMany(PedidoDetalle::class,'producto_id');}

}
