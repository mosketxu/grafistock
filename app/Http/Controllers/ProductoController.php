<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:producto.index')->only('index');
        $this->middleware('can:producto.edit')->only('edit','update');
    }

    public function index()
    {
        return view('producto.index');
    }

    public function create()
    {
        return view('producto.create');
    }

    public function edit(Producto $producto)
    {
        return view('producto.edit',compact('producto'));
    }
}
