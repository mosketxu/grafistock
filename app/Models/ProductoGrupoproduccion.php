<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoGrupoproduccion extends Model
{
    use HasFactory;

    protected $table = 'producto_gruposproduccion';
    protected $fillable = ['sigla','nombre'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
