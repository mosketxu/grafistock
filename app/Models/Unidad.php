<?php

namespace App\Models;

use App\Http\Livewire\PresupLineaDetalle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'unidades';

    protected $fillable = ['nombre','nombrecorto'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function presupuestolineadetalles()
    {
        return $this->hasMany(PresupLineaDetalle::class,'udpreciocoste_id');
    }

}
