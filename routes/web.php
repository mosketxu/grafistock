<?php

use App\Http\Controllers\{AdministracionController, EntidadController, ProductoController, PedidoController,StockController, UserController, RoleController};
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
    Route::get('/dashboard', function () {return view('dashboard');})->middleware('can:dash')->name('dashboard');

    Route::resource('users', UserController::class)->names('users'); //cuando es resource para aplicar seguridad can hay que hacerlo en el controller
    // Route::resource('users', UserController::class)->except(['create'])->names('users'); //cuando es resource para aplicar seguridad can hay que hacerlo en el controller
    // rutas entidades
    Route::resource('entidad', EntidadController::class); //cuando es resource para aplicar seguridad can hay que hacerlo en el controller
    Route::resource('producto', ProductoController::class);
    Route::resource('pedido', PedidoController::class);
    //stock
    Route::get('stock/movimientos', [StockController::class,'movimientos'])->middleware('can:stock.movimientos')->name('stock.movimientos');
    Route::get('stock/producto', [StockController::class,'producto'])->middleware('can:stock.producto')->name('stock.producto');
    Route::get('stock/material', [StockController::class,'material'])->middleware('can:stock.material')->name('stock.material');
    Route::resource('stock', StockController::class);

    Route::get('administracion/', [AdministracionController::class,'index'])->middleware('can:administracion.index')->name('administracion.index');

    //roles
    Route::resource('roles', RoleController::class)->names('roles');
    Route::get('administracion/roles', [AdministracionController::class,'roles'])->middleware('can:administracion.index')->name('administracion.roles');
});;
