<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoTipo extends Model
{
    use HasFactory;


    protected $fillable = ['id','nombre','nombrecorto','aux'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
