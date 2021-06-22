<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use HasFactory;

    protected $fillable = ['sigla','nombre'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

}
