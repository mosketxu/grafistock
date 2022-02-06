<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\returnSelf;

class Pedido extends Model
{
    use HasFactory;



    protected $dates = ['deleted_at'];


    protected $fillable=['pedido','solicitante_id','entidad_id','fechapedido','fecharecepcionprevista','fecharecepcion','ubicacion_id','iva','ruta','fichero','estado','total','observaciones'];

    // protected $casts = [
    //     'fechapedido' => 'date:Y-m-d',
    //     'fecharecepcionprevista' => 'date:Y-m-d',
    //     'fecharecepcion' => 'date:Y-m-d',
    // ];

    public function recalculo()
    {
        $this->total=$this->pedidodetalles->sum('total');
        $this->save();
    }

    public function getFechapedAttribute()
    {
        return Carbon::parse($this->fechapedido)->format('d-m-Y');
    }

    public function getFecharecepprevAttribute()
    {
        if($this->fecharecepcionprevista)
            return Carbon::parse($this->fecharecepcionprevista)->format('d-m-Y');
        else
            return '-';
    }

    public function getFecharecepAttribute()
    {
        return Carbon::parse($this->fecharecepcion)->format('d-m-Y');
    }

    public function getStatusColorAttribute()
    {
        return [
            '0'=>['gray','En curso'],
            '1'=>['green','Recibido'],
            '2'=>['red','Anulado']
        ][$this->estado] ?? ['gray',''];
    }

    public function pedidodetalles()
    {
        return $this->hasMany(PedidoDetalle::class)->orderBy('orden');
    }

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function getRutaficheroAttribute()
    {
        return $this->ruta.'/'.$this->fichero;
    }

    public function scopeImprimirpedido()
    {
        $pedido=Pedido::with('entidad')
        ->with('pedidodetalles')
        ->find($this->id);

        $base=$pedido->pedidodetalles->sum('base');


        $pdf = \PDF::loadView('pedido.pedidopdf', compact(['pedido','base']));

        Storage::put('public/'.$pedido->ruta.'/'.$pedido->fichero, $pdf->output());

        return $pdf->download($pedido->fichero);
    }
}
