<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AccionesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('acciones')->delete();

        \DB::table('acciones')->insert([
            ['referencia' => 'I1','descripcion' => 'Impresion 1','acciontipo_id' => 1,'preciotarifa' => 1.0,'ud_id' => 1,'precioventa' => 2.0,'observaciones' => NULL],
            ['referencia' => 'I2','descripcion' => 'Impresion 2','acciontipo_id' => 2,'preciotarifa' => 2.0,'ud_id' => 1,'precioventa' => 2.0,'observaciones' => NULL],
            ['referencia' => 'A1','descripcion' => 'Acabados 1','acciontipo_id' => 3,'preciotarifa' => 3.0,'ud_id' => 1,'precioventa' => 4.0,'observaciones' => NULL],
            ['referencia' => 'A2','descripcion' => 'Acabados 2','acciontipo_id' => 3,'preciotarifa' => 4.0,'ud_id' => 1,'precioventa' => 5.0,'observaciones' => NULL],
            ['referencia' => 'M1','descripcion' => 'Manipulados 1','acciontipo_id' => 4,'preciotarifa' => 5.0,'ud_id' => 1,'precioventa' => 6.0,'observaciones' => NULL],
            ['referencia' => 'M2','descripcion' => 'Manipulados 2','acciontipo_id' => 4,'preciotarifa' => 6.0,'ud_id' => 1,'precioventa' => 7.0,'observaciones' => NULL],
            ['referencia' => 'E1','descripcion' => 'Embalajes 1','acciontipo_id' => 5,'preciotarifa' => 7.0,'ud_id' => 1,'precioventa' => 8.0,'observaciones' => NULL],
            ['referencia' => 'E2','descripcion' => 'Embalajes 2','acciontipo_id' => 5,'preciotarifa' => 8.0,'ud_id' => 1,'precioventa' => 9.0,'observaciones' => NULL],
            ['referencia' => 'T1','descripcion' => 'TRasnp 1','acciontipo_id' => 6,'preciotarifa' => 9.0,'ud_id' => 1,'precioventa' => 10.0,'observaciones' => NULL],
            ['referencia' => 'T2','descripcion' => 'Trasnp','acciontipo_id' => 6,'preciotarifa' => 10.0,'ud_id' => 1,'precioventa' => 11.0,'observaciones' => NULL],
            ['referencia' => 'X1','descripcion' => 'Externos 1','acciontipo_id' => 7,'preciotarifa' => 11.0,'ud_id' => 1,'precioventa' => 12.0,'observaciones' => NULL],
            ['referencia' => 'X2','descripcion' => 'Externos 2','acciontipo_id' => 7,'preciotarifa' => 12.0,'ud_id' => 1,'precioventa' => 13.0,'observaciones' => NULL],
        ]);


    }
}
