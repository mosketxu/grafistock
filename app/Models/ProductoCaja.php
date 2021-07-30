<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCaja extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','nombrecorto'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
