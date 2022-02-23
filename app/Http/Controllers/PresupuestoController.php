<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use App\Models\PresupuestoControlpartida;
use App\Models\PresupuestoLinea;

use Illuminate\Http\Request;
use Dompdf\Dompdf;

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
        // return view('presupuesto.create');
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

    public function imprimir(Presupuesto $presupuesto)
    {
        $presupuesto=Presupuesto::with('presupuestolineasvisibles')->find($presupuesto->id);
        $controlpartidas=PresupuestoControlpartida::get();
        $controlpartidaspendientes=$controlpartidas->where('presupuesto_id',$presupuesto->id)
            ->where('activo',true)
            ->where('contador','0');
        $controlpartidasactivas=PresupuestoControlpartida::query()
            ->where('presupuesto_id',$presupuesto->id)
            ->where('activo',true)
            ->where('contador','>','0')
            ->get();

       return view('presupuesto.presupuestofichapdf', compact(['presupuesto','controlpartidasactivas','controlpartidaspendientes']));
        // $pdf = \PDF::loadView('presupuesto.presupuestofichapdf', compact(['presupuesto','controlpartidasactivas','controlpartidaspendientes']));
        // $pdf->setPaper('a4','landscape');

        // return $pdf->download('presupuesto.pdf'); //así lo descarga

        // return $pdf->stream('ficha.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function show(Presupuesto $presupuesto)
    {
        $presupuesto=Presupuesto::with('presupuestolineas','presupuestolineas.presupuestolineadetalles')->find($presupuesto->id);

        // return view('presupuesto.presupuestopdf', compact(['presupuesto']));

        $pdf = \PDF::loadView('presupuesto.presupuestopdf', compact(['presupuesto']));
        // $pdf = \PDF::loadView('presupuesto.presupuestopdfpruebarapida', );

        $pdf->setPaper('a4','portrait');

        // return $pdf->download('presupuesto.pdf'); //así lo descarga

        return $pdf->stream('invoice.pdf'); //asi lo muestra por pantalla

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
