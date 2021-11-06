<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nombrecorto',3);
            $table->double('factormaterial', 15, 2);
            $table->double('preciotintamin', 15, 2);
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
        Schema::dropIfExists('empresa_tipos');
    }
}