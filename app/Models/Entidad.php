<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;
    protected $table = 'entidades';
    protected $fillable=['entidad','entidadtipo_id','empresatipo_id','entidadcategoria_id','presupuesto','comercial_id','direccion','cp','localidad','provincia_id','pais_id',
                        'nif','tfno','emailgral','emailadm','emailaux','web','idioma',
                        'banco1','iban1','banco2','iban2','banco3','iban3','factor',
                        'metodopago_id','diafactura','diavencimiento',
                        'cuentactblepro','cuentactblecli','observaciones','estado','password'];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function comercial()
    {
        return $this->belongsTo(User::class,'comercial_id');
    }

    public function empresatipo()
    {
        return $this->belongsTo(EmpresaTipo::class,'empresatipo_id')->withDefault([
            'factormin' => '-',
        ]);
    }

    public function empresacategoria()
    {
        return $this->belongsTo(empresacategoria::class,'empresacategoria_id');
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function entidadtipo()
    {
        return $this->belongsTo(EntidadTipo::class);
    }

    public function metodopago()
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class);
    }

    public function presuplindetalleproveedor()
    {
        return $this->hasMany(PresupuestoLineaDetalle::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function movimientos()
    {
        return $this->belongsTo(StockMovimiento::class);
    }
}
