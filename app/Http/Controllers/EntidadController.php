<?php

namespace App\Http\Controllers;

use App\Models\{Entidad,EntidadTipo};
use Illuminate\Http\Request;

class EntidadController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:entidad.index')->only('index');
        $this->middleware('can:entidad.edit')->only('edit','update');
    }

    public function index()
    {
        $entidadtipo_id='0';
        return view('entidad.index',compact('entidadtipo_id'));
    }

    public function tipo($entidadtipo_id)
    {
        return view('entidad.index',compact('entidadtipo_id'));
    }

    public function nueva($entidadtipo_id)
    {
        return view('entidad.create',compact('entidadtipo_id'));
    }

    public function edit(Entidad $entidad)
    {
        $entidadtipoId = $entidad->entidadtipo_id;
        return view('entidad.edit',compact('entidad','entidadtipoId'));
    }

}
