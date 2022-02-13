<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadCategoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','nombrecorto','nombreplural'];

    protected $primaryKey = 'id';
    public $incrementing = false;

    public function entidad()
    {
        return $this->hasOne(Entidad::class,'entidadtipo_id','id');
    }
}
