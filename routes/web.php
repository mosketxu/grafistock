<?php

use App\Http\Controllers\{AdministracionController, EntidadController, ProductoController, PedidoController,StockController, UserController, RoleController,StockPeticionController};
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
        if (Auth::user()->hasRole('Operario'))
            return redirect()->route('stock.movimientos');
        else
            return view('dashboard');}
    )->name('dashboard');


    //roles
    Route::resource('roles', RoleController::class)->names('roles');
    Route::get('administracion', [AdministracionController::class,'index'])->middleware('can:administracion')->name('administracion.index');
    // Route::get('administracion/roles', [AdministracionController::class,'roles'])->middleware('can:administracion')->name('administracion.roles');

        Route::resource('users', UserController::class)->names('users'); //cuando es resource para aplicar seguridad can hay que hacerlo en el controller
    // Route::resource('users', UserController::class)->except(['create'])->names('users'); //cuando es resource para aplicar seguridad can hay que hacerlo en el controller
    // rutas entidades
    Route::get('clientes', [EntidadController::class,'cli'])->middleware('can:entidad.index')->name('entidad.cli'); //
    Route::get('proveedores', [EntidadController::class,'pro'])->middleware('can:entidad.index')->name('entidad.pro'); //
    Route::get('entidad/{tipo}', [EntidadController::class,'nueva'])->name('entidad.nueva');
    Route::resource('entidad', EntidadController::class)->only(['create', 'edit']); //cuando es resource para aplicar seguridad can hay que hacerlo en el controller
    Route::resource('producto', ProductoController::class);
    Route::resource('pedido', PedidoController::class);
    //stock
    Route::get('stock/movimientos', [StockController::class,'movimientos'])->middleware('can:stock.index')->name('stock.movimientos');
    Route::get('stock/producto', [StockController::class,'producto'])->middleware('can:stock.index')->name('stock.producto');
    Route::get('stock/material', [StockController::class,'material'])->middleware('can:stock.index')->name('stock.material');
    Route::resource('stock', StockController::class);
    Route::resource('stockpeticion', StockPeticionController::class);
    // Route::get('/clear-cache', function() {
    //     Artisan::call('cache:clear');
    //     return "Cache is cleared";
    // })->name('clearcache');

});;
