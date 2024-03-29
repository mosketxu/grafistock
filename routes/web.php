<?php

use App\Http\Controllers\{DashboardController, AdministracionController, EntidadController, EntidadContactoController,ProductoController,
        PedidoController,StockController,
        UserController, RoleController,
        StockPeticionController, PresupuestoController, PresupuestoLineaController,AccionController};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->hasRole('Operario')) {
            return redirect()->route('stock.movimientos');
        } elseif (Auth::user()->hasRole('Comercial')) {
            return redirect()->route('presupuesto.index');
        } elseif (Auth::user()->hasRole('Gestion')) {
            return redirect()->route('dashboard.presupuesto');
        } else {
            return redirect()->route('producto.index');
        }
    })->name('dashboard');


    //Dashboards
    Route::get('dashboard/presupuestos', [DashboardController::class,'presupuestos'])->name('dashboard.presupuestos');

    //roles
    Route::resource('roles', RoleController::class)->names('roles');
    Route::get('administracion', [AdministracionController::class,'index'])->middleware('can:administracion')->name('administracion.index');

    //Users
    Route::resource('users', UserController::class)->names('users'); //cuando es resource para aplicar seguridad can hay que hacerlo en el controller

    // Entidades
    Route::get('entidad/{tipo}/tipo', [EntidadController::class,'tipo'])->middleware('can:entidad.index')->name('entidad.tipo'); //
    Route::get('entidad/{entidadtipo_id}/nueva', [EntidadController::class,'nueva'])->name('entidad.nueva');
    Route::resource('entidad', EntidadController::class)->only(['index','create', 'edit']); //cuando es resource para aplicar seguridad can hay que hacerlo en el controller


    //Entidades contacto
    Route::get('entidadcontacto/{entidad}/nuevo', [EntidadContactoController::class,'nuevo'])->name('entidadcontacto.nuevo');
    Route::resource('entidadcontacto', EntidadContactoController::class)->only(['show','edit','store']);
    // Producto
    Route::resource('producto', ProductoController::class);

    // Pedidos de stock
    Route::resource('pedido', PedidoController::class);

    //stock
    Route::get('stock/movimientos', [StockController::class,'movimientos'])->middleware('can:stock.index')->name('stock.movimientos');
    Route::get('stock/producto', [StockController::class,'producto'])->middleware('can:stock.index')->name('stock.producto');
    // Route::get('stock/material', [StockController::class,'material'])->middleware('can:stock.index')->name('stock.material');
    Route::resource('stock', StockController::class);

    //pedidos stock
    Route::resource('stockpeticion', StockPeticionController::class);

    //presupuestos
    Route::get('presupuesto/indexvble/{search}/{filtroanyo}/{filtromes}/{filtroclipro}/{filtrosolicitante}/{filtropalabra}/{filtroestado}}', [PresupuestoController::class,'indexvble'])->name('presupuesto.indexvbles');
    Route::get('presupuesto/composicion/{presupuesto}/{search}/{filtroanyo}/{filtromes}/{filtroclipro}/{filtrosolicitante}/{filtropalabra}/{filtroestado}}', [PresupuestoController::class,'composicion'])->name('presupuesto.composicion');
    Route::get('presupuesto/ficha/{presupuesto}/{totales}', [PresupuestoController::class,'imprimir'])->name('presupuesto.imprimir');
    Route::get('presupuesto/ficha/{presupuesto}', [PresupuestoController::class,'html'])->name('presupuesto.html');
    Route::resource('presupuesto', PresupuestoController::class);

    //presupuestolineadetalle
    Route::get('presupuestolinea/{presupuestolinea}', [PresupuestoLineaController::class,'index'])->name('presupuestolinea.index');
    Route::get('presupuestolinea/{presupuestolinea}/{acciontipoId}', [PresupuestoLineaController::class,'create'])->name('presupuestolinea.create');

    //Acciones
    Route::resource('accion', AccionController::class);


    // Route::get('/clear-cache', function() {
    //     Artisan::call('cache:clear');
    //     return "Cache is cleared";
    // })->name('clearcache');

});;
