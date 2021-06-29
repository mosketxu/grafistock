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
    // Route::get('stock/{productoId}/movimientos', [stockController::class,'movimientos'])->name('stock.movimientos');
    Route::resource('stock', StockController::class);
});;
