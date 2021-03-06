<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('nombrecorto')->unique();
            $table->double('aux', 15, 2)->default(0.05);
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
        Schema::dropIfExists('producto_tipos');
    }
}
