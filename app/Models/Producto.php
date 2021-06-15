<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    use HasFactory;
    protected $table = 'productos';
    protected $fillable=['referencia','material_id','grosor','ud_grosor','seccion','ancho','alto','ud_tamanyo','ubicacion','coste','ud_coste','ud_compra','pdf','observaciones'];


    public function material()
    {
        return $this->belongsTo(Material::class);
    }

}
