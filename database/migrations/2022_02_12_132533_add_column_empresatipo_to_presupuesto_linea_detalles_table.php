<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEmpresatipoToPresupuestoLineaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuesto_linea_detalles', function (Blueprint $table) {
            $table->foreignId('empresatipo_id')->nullable()->default('4')->constrained('empresa_tipos')->after('entidad_id');
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
            $table->dropColumn('empresatipo_id');
        });
    }
}
