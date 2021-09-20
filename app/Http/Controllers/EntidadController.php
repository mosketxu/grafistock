<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use Illuminate\Http\Request;

class EntidadController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:entidad.index')->only('index');
        $this->middleware('can:entidad.edit')->only('edit','update');
    }

    public function cli()
    {
        $cliente='1';
        $proveedor='0';
        return view('entidad.index',compact('cliente','proveedor'));
    }
    public function pro()
    {
        $cliente='0';
        $proveedor='1';
        return view('entidad.index',compact('cliente','proveedor'));
    }

    public function nueva($tipo)
    {
        return view('entidad.create',compact('tipo'));
    }

    public function edit(Entidad $entidad)
    {
        $tipo = $entidad->cliente=="1" ? 'Cliente' : 'Proveedor';
        return view('entidad.edit',compact('entidad','tipo'));
    }

}
