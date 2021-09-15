<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPeticion extends Model
{
    use HasFactory;

    protected $table = 'stock_peticiones';
    protected $fillable = ['solicitante_id','peticion','fechasolicitud','fecharealizado','estado','observaciones'];

    protected $casts = [
        'fechasolicitud' => 'date:Y-m-d',
        'fecharealizado' => 'date:Y-m-d',
    ];

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }

    public function getStatusColorAttribute()
    {
        return [
            '0'=>['red','Pendiente'],
            '1'=>['yellow','Curso'],
            '2'=>['green','Finalizado']
        ][$this->estado] ?? ['gray',''];
    }

}
