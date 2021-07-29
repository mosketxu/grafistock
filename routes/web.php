<?php

use App\Http\Controllers\{EntidadController, ProductoController, PedidoController,StockController};
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
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    // rutas entidades
    Route::resource('entidad', EntidadController::class);
    Route::resource('producto', ProductoController::class);
    Route::resource('pedido', PedidoController::class);
    //stock
    Route::get('stock/movimientos', [StockController::class,'movimientos'])->name('stock.movimientos');
    Route::get('stock/producto', [StockController::class,'producto'])->name('stock.producto');
    Route::get('stock/material', [StockController::class,'material'])->name('stock.material');
    Route::resource('stock', StockController::class);
});;
