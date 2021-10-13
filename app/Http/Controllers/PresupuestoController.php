<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:presupuesto.index');
        $this->middleware('can:presupuesto.edit')->only('edit','update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('presupuesto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('presupuesto.create');
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
     * @param  \App\Models\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function show(Presupuesto $presupuesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Presupuesto $presupuesto)
    {
        return view('presupuesto.edit',compact('presupuesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presupuesto $presupuesto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presupuesto $presupuesto)
    {
        //
    }
}
