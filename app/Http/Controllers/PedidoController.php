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


    public function show($entidadId)
    {
        dd('mirar de FacturacionController');
    }

    public function edit(Pedido $pedido)
    {
        return view('pedido.edit',compact('pedido'));
    }


}
