<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:dashboard.presupuestos')->only('presupuestos');;
    }

    public function presupuestos()
    {
        return view('dashboard.presupuestos');
    }
}
