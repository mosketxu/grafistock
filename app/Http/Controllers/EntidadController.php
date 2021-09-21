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
        $clipro_id='1';
        return view('entidad.index',compact('clipro_id'));
    }
    public function pro()
    {
        $clipro_id='2';
        return view('entidad.index',compact('clipro_id'));
    }

    public function nueva($tipo)
    {
        return view('entidad.create',compact('tipo'));
    }

    public function edit(Entidad $entidad)
    {
        $tipo = $entidad->clipro_id=="1" ? 'Cliente' : 'Proveedor';
        return view('entidad.edit',compact('entidad','tipo'));
    }

}
