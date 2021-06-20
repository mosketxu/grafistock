<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    use HasFactory;
    protected $table = 'productos';
    protected $fillable=['referencia','material_id','grosor','ud_grosor','seccion','ancho','alto','ud_tamanyo','ubicacion','coste','ud_coste','ud_compra','pdf','observaciones'];


    public function ubicacion(){return $this->belongsTo(Ubicacion::class);}

    public function material(){return $this->belongsTo(ProductoMaterial::class);}

    public function acabado(){return $this->belongsTo(ProductoAcabado::class);}

    public function calidad(){return $this->belongsTo(ProductoCalidad::class);}

    public function clase(){return $this->belongsTo(ProductoClase::class);}

    public function grupoproduccion(){return $this->belongsTo(ProductoGrupoproduccion::class);}

    public function tipo(){return $this->belongsTo(ProductoTipo::class);}

}
