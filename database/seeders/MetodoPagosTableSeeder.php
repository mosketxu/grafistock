<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MetodoPagosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('metodo_pagos')->delete();

        \DB::table('metodo_pagos')->insert(array (
            0 =>array ('id' => 1,'nombre' => 'Transferencia IBAN: ESxx xxx xxxx xxxx xxxx','nombrecorto' => 'Transferencia',),
            1 =>array ('id' => 2,'nombre' => 'Recibo Domiciliado','nombrecorto' => 'Recibo',),
            2 =>array ('id' => 3,'nombre' => 'No Definida','nombrecorto' => 'No.Def',),
            3 =>array ('id' => 4,'nombre' => 'No Aplica','nombrecorto' => 'No Aplica',),
        ));


    }
}
