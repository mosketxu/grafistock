<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEntidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entidades', function (Blueprint $table) {
            $table->double('ratio', 15, 2)->nullable()->after('iban3');
            $table->foreignId('empresatipo_id')->nullable()->constrained('empresa_tipos')->after('entidadtipo_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entidades', function (Blueprint $table) {
            $table->dropColumn('ratio');
        });
    }
}
