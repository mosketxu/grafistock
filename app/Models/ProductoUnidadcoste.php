<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoUnidadcoste extends Model
{
    use HasFactory;

    protected $table = 'producto_unidadescoste';

    protected $fillable = ['sigla','nombre'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
