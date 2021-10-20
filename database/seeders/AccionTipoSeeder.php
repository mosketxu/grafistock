<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AccionTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('accion_tipos')->delete();


        \DB::table('accion_tipos')->insert(array (
            1 =>array ('id' => 1,'nombre' => 'Material','nombrecorto' => 'MAT',),
            2 =>array ('id' => 2,'nombre' => 'Impresion','nombrecorto' => 'IMP',),
            3 =>array ('id' => 3,'nombre' => 'Acabados','nombrecorto' => 'ACA',),
            4 =>array ('id' => 4,'nombre' => 'Manipulados','nombrecorto' => 'MAN',),
            5 =>array ('id' => 5,'nombre' => 'Embalajes','nombrecorto' => 'EMB',),
            6 =>array ('id' => 6,'nombre' => 'Transporte','nombrecorto' => 'TRA',),
            7 =>array ('id' => 7,'nombre' => 'Externo','nombrecorto' => 'EXT',),
        ));
    }
}
