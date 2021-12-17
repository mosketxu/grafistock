<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadCoste extends Model
{
    use HasFactory;

    protected $table = 'unidadescoste';

    protected $fillable = ['nombre','nombrecorto'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
