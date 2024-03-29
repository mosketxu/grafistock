<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    use HasFactory;

    protected $table = 'pedido_detalles';

    protected $fillable=['pedido_id','producto_id','orden','cantidad','coste','udcompra_id','iva','total'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function unidadcompra()
    {
        return $this->belongsTo(UnidadCoste::class,'udcompra_id','id');
    }

    public function getBaseAttribute(){
        return round($this->cantidad*$this->coste,2);
    }

    public function getTotalivaAttribute(){
        return round($this->cantidad*$this->coste*$this->iva,2);
    }

    public function getTotaAttribute(){
        return round((1+$this->iva)*$this->cantidad*$this->coste,2);
    }

}
