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
            $table->foreignId('entidad_id')->constrained('entidades');
            $table->string('referencia')->unique()->index();
            $table->string('descripcion')->nullable();
            $table->integer('tipo_id')->index();
            $table->foreignId('material_id')->nullable()->constrained('producto_materiales');
            $table->double('grosor_mm', 15, 2)->default(0.00)->nullable();
            $table->integer('ancho')->default(0)->nullable();
            $table->integer('udancho_id')->nullable();
            $table->integer('alto')->default(0)->nullable();
            $table->integer('udalto_id')->nullable();
            $table->integer('acabado_id')->index()->nullable();
            $table->integer('grupoproduccion_id')->index();
            $table->integer('familia_id')->index()->nullable();
            $table->integer('udsolicitud_id')->nullable();
            $table->double('preciocoste', 15, 3)->default(0.00)->nullable();
            $table->integer('udpreciocoste_id')->nullable();
            $table->double('preciocompra', 15, 3)->default(0.00)->nullable();
            $table->integer('udpreciocompra_id')->nullable();
            $table->integer('caja_id')->nullable();
            $table->double('costecaja', 15, 2)->default(0.00)->nullable();
            $table->integer('ubicacion_id')->nullable();
            $table->string('fichaproducto')->nullable();
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
