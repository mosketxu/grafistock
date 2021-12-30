<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMunutosToPresupuestoLineaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuesto_linea_detalles', function (Blueprint $table) {
            $table->double('minutos', 15, 2)->default(1.00)->after('unidades');
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
            $table->dropColumn('minutos');
        });
    }
}
