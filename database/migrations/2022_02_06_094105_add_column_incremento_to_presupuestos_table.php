<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIncrementoToPresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuestos', function (Blueprint $table) {
            $table->double('incremento', 15, 2)->default(0.00)->after('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presupuestos', function (Blueprint $table) {
            $table->dropColumn('incremento');
        });
    }
}
