<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaTipo extends Model
{
    use HasFactory;
    protected $fillable=['nombre','nombrecorto'];

    public function entidad()
    {
        return $this->hasMany(Entidad::class);
    }


}
