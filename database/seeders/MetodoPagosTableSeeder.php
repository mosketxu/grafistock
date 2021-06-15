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
            0 =>array ('id' => 1,'metodopago' => 'Transferencia IBAN: ESxx xxx xxxx xxxx xxxx','metodopagocorto' => 'Transferencia',),
            1 =>array ('id' => 2,'metodopago' => 'Recibo Domiciliado','metodopagocorto' => 'Recibo',),
            2 =>array ('id' => 3,'metodopago' => 'No Definida','metodopagocorto' => 'No.Def',),
            3 =>array ('id' => 4,'metodopago' => 'No Aplica','metodopagocorto' => 'No Aplica',),
        ));


    }
}
