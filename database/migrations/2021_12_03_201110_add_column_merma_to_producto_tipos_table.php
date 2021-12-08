<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAuxToProductoTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producto_tipos', function (Blueprint $table) {
            $table->double('auxiliar', 15, 2)->default(0.05)->after('nombrecorto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producto_tipos', function (Blueprint $table) {
            $table->dropColumn('auxiliar');
        });
    }
}
