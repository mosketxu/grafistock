<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoFamilia extends Model
{
    use HasFactory;

    protected $table = 'producto_familias';
    protected $fillable = ['nombre','nombrecorto'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
