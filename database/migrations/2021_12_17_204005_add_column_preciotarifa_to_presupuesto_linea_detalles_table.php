<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPreciotarifaToPresupuestoLineaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuesto_linea_detalles', function (Blueprint $table) {
            $table->double('preciotarifa', 15, 2)->default(0.00)->after('preciotarifa_ud');
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
            $table->dropColumn('preciotarifa');
        });
    }
}
