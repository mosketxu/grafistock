<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('presupuesto_linea_detalles', function (Blueprint $table) {
            $table->double('incrementoanual',15,2)->default(0)->after('entidad_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presupuesto_linea_detalles', function (Blueprint $table) {
            $table->dropColumn('incrementoanual')->default('0.00');
        });
    }
};
