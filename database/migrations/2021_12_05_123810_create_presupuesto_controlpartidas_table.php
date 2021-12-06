<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestoControlpartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_controlpartidas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presupuesto_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('presupuesto_id')->constrained('presupuestos')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('acciontipo_id');
            $table->integer('contador')->default(0);
            $table->integer('activo')->default(1);
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
        Schema::dropIfExists('presupuesto_controlpartidas');
    }
}
