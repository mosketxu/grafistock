<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPeticionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_peticiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitante_id')->nullable()->constrained('solicitantes')->cascadeOnUpdate()->nullOnDelete();
            $table->string('peticion');
            $table->date('fechasolicitud');
            $table->date('fecharealizado')->nullable();
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
        Schema::dropIfExists('stock_peticiones');
    }
}
