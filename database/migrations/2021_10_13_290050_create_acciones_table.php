<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acciones', function (Blueprint $table) {
            $table->id();
            $table->string('referencia')->unique()->index();
            $table->string('descripcion')->nullable();
            $table->foreignId('acciontipo_id')->constrained('accion_tipos');
            $table->double('preciocoste', 15, 2)->default(0.00)->nullable();
            $table->double('preciominimo', 15, 2)->default(0.00)->nullable();
            $table->double('precioventa', 15, 2)->default(0.00)->nullable();
            $table->integer('udpreciocoste_id')->nullable();
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
        Schema::dropIfExists('acciones');
    }
}
