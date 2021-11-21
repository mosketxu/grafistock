<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccionTipo extends Model
{
    use HasFactory;
    protected $fillable=['nombre','nombrecorto'];

    public function acciones()
    {
        return $this->hasMany(Accion::class);
    }

}
