<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;



class AdministracionController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('can:administracion');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administracion.index');
    }
}
