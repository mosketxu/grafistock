<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPreciominimoColumnToAccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acciones', function (Blueprint $table) {
            $table->double('preciominimo', 15, 2)->default(0.00)->nullable()->after('preciocoste');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acciones', function (Blueprint $table) {
            $table->dropColumn('preciominimo');

        });
    }
}
