<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('referencia')->unique()->index();
            $table->integer('material_id')->nullable();
            $table->integer('solicitante_id')->nullable();
            $table->integer('grosor')->nullable();
            $table->string('ud_grosor')->nullable();
            $table->string('seccion')->nullable();
            $table->integer('ancho')->nullable();
            $table->integer('alto')->nullable();
            $table->string('ud_tamanyo')->nullable();
            $table->integer('ubicacion')->nullable();
            $table->double('coste', 15, 2)->default(0.00);
            $table->string('ud_coste')->nullable();
            $table->string('ud_compra')->nullable();
            $table->string('pdf')->nullable();
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
        Schema::dropIfExists('productos');
    }
}
