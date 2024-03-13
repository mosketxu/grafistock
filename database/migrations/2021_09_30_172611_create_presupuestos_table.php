<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitante_id')->nullable()->constrained('solicitantes')->cascadeOnUpdate()->nullOnDelete();
            $table->string('presupuesto','7')->index()->nullable()->unique();
            $table->string('descripcion')->nullable();
            $table->foreignId('entidad_id')->constrained('entidades');
            $table->date('fechapresupuesto');
            $table->double('preciocoste', 15, 2)->nullable();
            $table->double('precioventa', 15, 2)->nullable();
            $table->double('unidades', 15, 2)->nullable();
            $table->double('iva', 15, 2)->default('0.21');
            $table->string('ruta')->nullable();
            $table->string('fichero')->nullable();
            $table->integer('estado')->default('0');
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
        Schema::dropIfExists('presupuestos');
    }
}
