<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use App\Models\EntidadContacto;
use Illuminate\Http\Request;

class EntidadContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('can:entidadcontacto.index')->only('show');
        $this->middleware('can:entidadcontacto.edit')->only('edit','nuevo');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //         $entidad=Entidad::find($contacto->entidad_id);
        // return view('entidad.contacto',compact(['contacto','entidad']));
        // return view('entidadcontacto.create',compact(['entidad']));
    }

    public function nuevo(Entidad $entidad)
    {
        return view('entidad.contactonuevo',compact(['entidad']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('entidad.contactos',compact(['id']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contacto=EntidadContacto::find($id);
        $entidad=Entidad::find($contacto->entidad_id);
        return view('entidad.contacto',compact(['contacto','entidad']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
