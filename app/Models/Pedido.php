<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;



    protected $dates = ['deleted_at'];

    protected $casts = [
        'fechapedido' => 'date:Y-m-d',
        'fecharecepcionprevista' => 'date:Y-m-d',
        'fecharecepcion' => 'date:Y-m-d',
    ];

    protected $fillable=['pedido','entidad_id','fechapedido','fecharecepcionprevista','fecharecepcion','iva','ruta','fichero','observaciones'];

    public function pedidodetalles()
    {
        return $this->hasMany(DetallePedido::class)->orderBy('orden');
    }
}
