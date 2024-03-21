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
        $this->middleware('can:presupuesto.edit')->only('edit','update','composicion');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search='';
        $filtroanyo=date('Y');
        $filtromes='';
        $filtroclipro='';
        $filtrosolicitante='';
        $filtropedidominimo='';
        $filtropalabra='';
        $filtroestado='';

        return view('presupuesto.index',compact(['search','filtroanyo','filtromes','filtroclipro','filtrosolicitante','filtropalabra','filtroestado','filtropedidominimo']));
    }

    public function indexvble($search,$filtroanyo,$filtromes,$filtroclipro,$filtrosolicitante,$filtropalabra,$filtroestado,$filtropedidominimo)
    {
        $search=str_replace('@_','',$search);
        $filtroanyo=str_replace('@_','',$filtroanyo);
        $filtromes=str_replace('@_','',$filtromes);
        $filtroclipro=str_replace('@_','',$filtroclipro);
        $filtrosolicitante=str_replace('@_','',$filtrosolicitante);
        $filtropedidominimo=str_replace('@_','',$filtropedidominimo);
        $filtropalabra=str_replace('@_','',$filtropalabra);
        $filtroestado=str_replace('@_','',$filtroestado);

        return view('presupuesto.index',compact(['search','filtroanyo','filtromes','filtroclipro','filtrosolicitante','filtropalabra','filtroestado']));
    }

    public function html(Presupuesto $presupuesto)
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
    }

    public function imprimir(Presupuesto $presupuesto,$totales)
    {
        $presupuesto=Presupuesto::with('presupuestolineas','presupuestolineas.presupuestolineadetalles')->find($presupuesto->id);
        $pdf = \PDF::loadView('presupuesto.presupuestopdf', compact(['presupuesto','totales']));
        $pdf->setPaper('a4','portrait');
        return $pdf->stream('invoice.pdf'); //asi lo muestra por pantalla
    }

    public function composicion(Presupuesto $presupuesto,$search,$filtroanyo,$filtromes,$filtroclipro,$filtrosolicitante,$filtropalabra,$filtroestado,$filtropedidominimo){
        // $search= str_replace('@_','',$search);
        // $filtroanyo= str_replace('@_','',$filtroanyo);
        // $filtromes= str_replace('@_','',$filtromes);
        // $filtroclipro= str_replace('@_','',$filtroclipro);
        // $filtrosolicitante= str_replace('@_','',$filtrosolicitante);
        // $filtropedidominimo= str_replace('@_','',$filtropedidominimo);
        // $filtropalabra= str_replace('@_','',$filtropalabra);
        // $filtroestado= str_replace('@_','',$filtroestado);
        return view('presupuesto.edit',compact(['presupuesto','search','filtroanyo','filtromes','filtroclipro','filtrosolicitante','filtropalabra','filtroestado','filtropedidominimo']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Presupuesto $presupuesto)
    {
        $search='';
        $filtroanyo='';
        $filtromes='';
        $filtroclipro='';
        $filtrosolicitante='';
        $filtropedidominimo='';
        $filtropalabra='';
        $filtroestado='';


        // return view('presupuesto.edit',compact('presupuesto'));
        return view('presupuesto.edit',compact('presupuesto','search','filtroanyo','filtromes','filtroclipro','filtrosolicitante','filtropalabra','filtroestado'));
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
