<?php

namespace App\Http\Controllers;

use App\Models\StockPeticion;
use Illuminate\Http\Request;

class StockPeticionController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:stockpeticion.index')->only('index');
        $this->middleware('can:stockpeticion.edit')->only('edit','create',);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stockpeticion.index');
    }

    public function create()
    {
        return view('stockpeticion.create');
    }

    public function edit(StockPeticion $stockpeticion)
    {
        return view('stockpeticion.edit',compact('stockpeticion'));
    }

}
