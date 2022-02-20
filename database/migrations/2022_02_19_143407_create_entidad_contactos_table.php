<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntidadContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidad_contactos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entidad_id')->constrained('entidades')->onDelete('cascade');
            $table->string('contacto');
            $table->string('cargo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('movil')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('entidad_contactos');
    }
}
