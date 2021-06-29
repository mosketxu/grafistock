<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;
    protected $table = 'entidades';
    protected $fillable=['entidad','direccion','cp','localidad','provincia_id','pais_id',
                        'nif','tfno','emailgral','emailadm','web','idioma',
                        'banco1','iban1','banco2','iban2','banco3','iban3',
                        'metodopago_id','diafactura','diavencimiento',
                        'cuentacontable','observaciones','estado','usuario','password'];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function metodopago()
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function productos()
    {
        return $this->hasMany(Productos::class);
    }

    public function movimientos()
    {
        return $this->belongsTo(StockMovimiento::class);
    }
}
