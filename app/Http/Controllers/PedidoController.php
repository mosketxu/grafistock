<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        return view('pedido.index');
    }

    public function create()
    {
        return view('pedido.create');
    }


    public function show($pedidoId)
    {
        $pedido=Pedido::with('entidad')
        ->with('pedidodetalles')
        ->find($pedidoId);

        $base=$pedido->pedidodetalles->sum('base');

        $pdf = \PDF::loadView('pedido.pedidopdf', compact(['pedido','base']));
        return $pdf->stream('invoice.pdf');

    }

    public function edit(Pedido $pedido)
    {
        return view('pedido.edit',compact('pedido'));
    }


}
