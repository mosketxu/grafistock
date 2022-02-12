<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsPreciosimpresionToAccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acciones', function (Blueprint $table) {
            $table->double('precioventa2', 15, 2)->default(0.00)->nullable()->after('precioventa');
            $table->double('precioventa3', 15, 2)->default(0.00)->nullable()->after('precioventa2');
            $table->double('precioventa4', 15, 2)->default(0.00)->nullable()->after('precioventa3');

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
            //
        });
    }
}
