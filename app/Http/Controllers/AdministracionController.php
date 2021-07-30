<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use App\Models\ProductoAcabado;
use App\Models\ProductoCaja;
use App\Models\ProductoCalidad;
use App\Models\ProductoClase;
use App\Models\ProductoGrupoproduccion;
use App\Models\ProductoMaterial;
use App\Models\ProductoTipo;
use App\Models\ProductoUnidadcoste;
use App\Models\Solicitante;
use App\Models\Ubicacion;
use App\Models\Unidad;
use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $acabados=ProductoAcabado::orderBy('nombre')->simplePaginate(10);
        $cajas=ProductoCaja::orderBy('nombre')->simplePaginate(10);
        $calidades=ProductoCalidad::orderBy('nombre')->simplePaginate(10);
        $clases=ProductoClase::orderBy('nombre')->simplePaginate(10);
        $gruposproduccion=ProductoGrupoproduccion::orderBy('nombre')->simplePaginate(10);
        $materiales=ProductoMaterial::orderBy('nombre')->simplePaginate(10);
        $tiposproducto=ProductoTipo::orderBy('nombre')->simplePaginate(10);
        $unidadescoste=ProductoUnidadcoste::orderBy('nombre')->simplePaginate(10);
        $solicitantes=Solicitante::orderBy('nombre')->simplePaginate(10);
        $ubicaciones=Ubicacion::orderBy('nombre')->simplePaginate(10);
        $unidades=Unidad::orderBy('nombre')->simplePaginate(10);
        return view('administracion.index',compact('acabados','cajas','calidades','clases','gruposproduccion','materiales','tiposproducto','unidadescoste','solicitantes','ubicaciones','unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function show(Administracion $administracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Administracion $administracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administracion $administracion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administracion  $administracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administracion $administracion)
    {
        //
    }
}
