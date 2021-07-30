<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SolicitantesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('solicitantes')->delete();
        
        \DB::table('solicitantes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Cassius Clay',
                'nombrecorto' => 'CC',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Mike Tyson',
                'nombrecorto' => 'MT',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Pedro Carrasco',
                'nombrecorto' => 'PC',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'Poli Diaz',
                'nombrecorto' => 'PD',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}