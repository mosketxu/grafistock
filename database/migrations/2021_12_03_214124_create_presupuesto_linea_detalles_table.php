<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestoLineaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_linea_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presupuestolinea_id')->constrained('presupuesto_lineas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('acciontipo_id')->constrained('accion_tipos')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('accionproducto_id')->index();
            $table->boolean('visible')->nullable()->default(true);
            $table->integer('orden')->nullable()->default('0');
            $table->string('descripcion')->nullable();
            $table->double('preciocoste_ud', 15, 2)->default(0.00);
            $table->double('precioventa_ud', 15, 2)->default(0.00);
            $table->double('precioventa', 15, 2)->default(0.00);
            $table->integer('udpreciocoste_id')->nullable();
            $table->double('factor', 15, 2)->default(1);
            $table->double('merma', 15, 2)->default(0);
            $table->double('unidades', 15, 2)->default(0.00);
            $table->double('alto', 15, 2)->nullable()->default(0.00);
            $table->double('ancho', 15, 2)->nullable()->default(0.00);
            // $table->double('metros2', 15, 2)->nullable()->default(0.00);
            $table->string('ruta')->nullable();
            $table->string('fichero')->nullable();
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
        Schema::dropIfExists('presupuesto_linea_detalles');
    }
}
