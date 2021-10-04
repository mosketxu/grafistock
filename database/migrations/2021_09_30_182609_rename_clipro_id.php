<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCliproId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entidades', function (Blueprint $table) {
            $table->renameColumn('clipro_id', 'entidadtipo_id');
            // añadir nombreplural
        });

        Schema::table('entidad_tipos', function (Blueprint $table) {
            $table->string('nombreplural')->after('nombrecorto');
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
            $table->renameColumn('entidadtipo_id','clipro_id');
        });
        Schema::table('entidad_tipos', function (Blueprint $table) {
            $table->dropColumn('nombreplural');
        });
    }
}
