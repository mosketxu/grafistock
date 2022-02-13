<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntidadCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidad_categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('nombrecorto')->unique();
            $table->timestamps();        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entidad_categorias');
    }
}
