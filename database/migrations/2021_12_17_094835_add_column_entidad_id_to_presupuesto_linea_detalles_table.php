<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEntidadIdToPresupuestoLineaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuesto_linea_detalles', function (Blueprint $table) {
            $table->foreignId('entidad_id')->nullable()->constrained('entidades')->after('accionproducto_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presupuesto_linea_detalles', function (Blueprint $table) {
            $table->dropColumn('entidad_id');
        });
    }
}
