<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos');
            $table->integer('orden')->default('0')->nullable();
            $table->integer('cantidad')->default('0');
            $table->double('coste', 15, 4)->default(0.00);
            $table->string('udcompra_id')->default('0');
            $table->double('iva', 15, 2)->default(0.00);

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
        Schema::dropIfExists('pedido_detalles');
    }
}
