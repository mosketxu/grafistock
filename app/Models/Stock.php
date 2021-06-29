<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable=['fechamovimiento','tipomovimiento','cantidad','producto_id','reentrada','observaciones','user_id'];

    protected $casts = [
        'fechamovimiento' => 'date:Y-m-d',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class,'producto_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getEntradaAttribute()
    {
        return [
            'S'=>'red',
            'E'=>'green',
        ][$this->tipomovimiento] ?? 'gray';
    }

    public function getDateMovAttribute()
    {
        if ($this->fechamovimiento) {
            return $this->fechamovimiento->format('d/m/Y');
        }
    }

}
