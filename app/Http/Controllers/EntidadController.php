<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use Illuminate\Http\Request;

class EntidadController extends Controller
{
    public function index()
    {
        return view('entidad.index');
    }

    public function create()
    {
        return view('entidad.create');
    }

    public function edit(Entidad $entidad)
    {
        return view('entidad.edit',compact('entidad'));
    }

}
