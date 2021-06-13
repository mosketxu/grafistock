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

    public function pus(Entidad $entidad)
    {
        return view('entidad.pus',compact('entidad'));
    }

    public function contactos(Entidad $entidad)
    {
        return view('entidad.contactos',compact('entidad'));
    }

    public function createcontacto($contactoId)
    {
        $contacto=Entidad::find($contactoId);
        return view('entidad.createcontacto',compact('contacto'));
    }

}
