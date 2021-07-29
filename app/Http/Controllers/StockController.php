<?php

namespace App\Http\Controllers;

use App\Models\StockMovimiento;


class StockController extends Controller
{

    public function index()
    {
        return view('stock.index');
    }

    public function create()
    {
        return view('stock.create');
    }

    public function edit(StockMovimiento $stock)
    {
        return view('stock.edit',compact('stock'));
    }

    public function movimientos()
    {
        return view('stock.movimientos');
    }
    public function productos()
    {
        return view('stock.productos');
    }
    public function material()
    {
        return view('stock.material');
    }
}
