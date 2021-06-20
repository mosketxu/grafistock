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
            $table->string('tipo_id',15)->index();
            $table->string('material_id',15)->index();
            $table->double('grosor_mm', 15, 2)->default(0.00)->nullable();
            $table->integer('ancho_mm')->default(0)->nullable();
            $table->integer('desarrollo_mm')->default(0)->nullable();
            $table->string('acabado_id',15)->index()->nullable();
            $table->string('grupoproduccion_id',15)->index();
            $table->string('clase_id',15)->index();
            $table->string('calidad_id',15)->index()->nullable();
            $table->string('udsolicitud_id',15)->index();
            $table->double('costeprov', 15, 2)->default(0.00)->nullable();
            $table->string('udcoste_id',15)->index();
            $table->double('costegrafitex', 15, 2)->default(0.00)->nullable();
            $table->string('udproducto_id',15)->index();
            $table->foreignId('entidad_id')->constrained('entidades');
            $table->string('caja_id',15)->index()->nullable();
            $table->double('costecaja', 15, 2)->default(0.00)->nullable();
            $table->string('pdf')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('ref_optimus')->nullable();
            $table->string('descrip_optimus')->nullable();
            $table->string('prov_optimus')->nullable();
            $table->string('refprov_optimus')->nullable();
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
