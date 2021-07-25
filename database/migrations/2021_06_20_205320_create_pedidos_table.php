<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('pedido')->index()->nullable();
            $table->foreignId('entidad_id')->constrained('entidades');
            $table->date('fechapedido');
            $table->date('fecharecepcionprevista')->nullable();
            $table->date('fecharecepcion')->nullable();
            $table->string('ruta')->nullable();
            $table->string('fichero')->nullable();
            $table->string('observaciones')->nullable();
            $table->boolean('finalizado')->default(false);
            $table->boolean('bloqueado')->default(false);
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
        Schema::dropIfExists('pedidos');
    }
}
