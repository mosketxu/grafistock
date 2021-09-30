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
            $table->foreignId('presupuesto_id')->constrained('presupuestos');
            $table->foreignId('producto_id')->nullable()->constrained('productos');
            $table->boolean('visible')->nullable()->default(true);
            $table->integer('orden')->nullable()->default('0');
            $table->string('descripcion');
            $table->double('preciocoste', 15, 2)->default(0.00);
            $table->double('precioventa', 15, 2)->default(0.00);
            $table->double('ratio', 15, 2)->default(0.00);
            $table->double('unidades', 15, 2)->default(0.00);
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
