<?php

namespace App\Http\Controllers;

use App\Models\Accion;
use App\Models\AccionTipo;
use App\Models\PresupuestoLinea;
use Illuminate\Http\Request;

class PresupuestoLineaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:presupuesto.index')->only('index');
        $this->middleware('can:presupuesto.edit')->only('index','create');
    }

    public function index(PresupuestoLinea $presupuestolinea)
    {
        return view('presupuestolinea.index',compact('presupuestolinea'));
    }


    public function create(PresupuestoLinea $presupuestolinea,$acciontipoId)
    {
        return view('presupuestolinea.create',compact('presupuestolinea','acciontipoId'));
    }


}
