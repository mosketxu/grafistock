<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitante_id')->constrained('solicitantes');
            $table->date('fechamovimiento');
            $table->string('tipomovimiento',1);
            $table->integer('cantidad');
            $table->foreignId('producto_id')->constrained('productos');
            $table->boolean('reentrada')->default(false)->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
