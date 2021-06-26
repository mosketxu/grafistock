<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $fillable=['pedido_id','producto_id','orden','cantidad','coste','udcompra','iva'];

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
        return $this->belongsTo(ProductoUnidadcoste::class,'udcompra','sigla');
    }

    public function getBaseAttribute(){
        return round($this->cantidad*$this->coste,2);
    }

    public function getTotalivaAttribute(){
        return round($this->cantidad*$this->coste*$this->iva,2);
    }

    public function getTotalAttribute(){
        return round((1+$this->iva)*$this->cantidad*$this->coste,2);
    }

}
