<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoMaterial extends Model
{
    use HasFactory;

    protected $table = 'producto_materiales';

    protected $fillable = ['nombre'];


    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

}
