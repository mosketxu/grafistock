<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidades', function (Blueprint $table) {
            $table->id();
            $table->string('entidad')->unique();
            $table->integer('entidadtipo_id')->default(0);

            $table->date('fechacliente')->nullable()->after('presupuesto');
            $table->double('incrementoanual',15,2)->default(0)->after('entidad_id');

            $table->string('cuentactblepro')->nullable();
            $table->string('cuentactblecli')->nullable();
            $table->string('entidad5',4)->unique()->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('cp', 10)->nullable();
            $table->string('localidad', 100)->nullable();
            $table->string('provincia_id', 2)->nullable();
            $table->string('pais_id', 2)->nullable()->default('ES');
            $table->string('nif', 12)->nullable()->unique();
            $table->string('tfno', 50)->nullable();
            $table->string('emailgral', 100)->nullable();
            $table->string('emailadm', 100)->nullable();
            $table->string('emailaux', 100)->nullable();
            $table->string('web', 100)->nullable();
            $table->string('banco1')->nullable();
            $table->string('iban1')->nullable();
            $table->string('banco2')->nullable();
            $table->string('iban2')->nullable();
            $table->string('banco3')->nullable();
            $table->string('iban3')->nullable();
            $table->string('usuario')->nullable();
            $table->string('password')->nullable();
            $table->integer('metodopago_id')->nullable()->default(1);
            $table->integer('diafactura')->nullable()->default(1);
            $table->integer('diavencimiento')->nullable()->default(10);
            $table->string('observaciones')->nullable();
            $table->boolean('estado')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entidades');
    }
}
