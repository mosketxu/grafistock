<?php

namespace App\Http\Controllers;


use App\Models\StockMovimiento;



class StockController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:stock.index')->only('index');
        $this->middleware('can:stock.edit')->only('edit','update');
    }

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

    public function producto()
    {
        $tipo='producto_id';
        return view('stock.balance',compact('tipo'));
    }

    // public function material()
    // {
    //     $tipo='material_id';
    //     return view('stock.balance',compact('tipo'));
    // }
}
