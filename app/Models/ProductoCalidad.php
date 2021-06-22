<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCalidad extends Model
{
    use HasFactory;

    protected $table = 'producto_calidades';
    protected $fillable = ['sigla','nombre'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
