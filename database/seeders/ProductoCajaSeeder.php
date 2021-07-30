<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoCajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vonombrecorto
     */
    public function run()
    {
        \DB::table('producto_cajas')->delete();

        \DB::table('producto_cajas')->insert([
            ['nombrecorto'=>'CAJA250','nombre'=>'CAJA 250 '],
            ['nombrecorto'=>'CAJA100','nombre'=>'CAJA 100'],
            ['nombrecorto'=>'CAJA125','nombre'=>'CAJA 125'],
            ['nombrecorto'=>'CAJA500','nombre'=>'CAJA 500'],
            ['nombrecorto'=>'CAJ300x4mm','nombre'=>'Cajas con 300 rollos x 4 mm'],
            ['nombrecorto'=>'CAJ300x6mm','nombre'=>'Cajas con 300 rollos x 6 mm'],
            ['nombrecorto'=>'CAJ300x12mm','nombre'=>'Cajas con 300 rollos x 12 mm'],
            ['nombrecorto'=>'CAJ300x15mm','nombre'=>'Cajas con 300 rollos x 15 mm'],
            ['nombrecorto'=>'CAJ300x20mm','nombre'=>'Cajas con 300 rollos x 20 mm'],
            ['nombrecorto'=>'CAJ300x25mm','nombre'=>'Cajas con 300 rollos x 25 mm'],
            ['nombrecorto'=>'BOL1000','nombre'=>'bolsa: 1000 unnombrecortoades'],
            ['nombrecorto'=>'PAQ50','nombre'=>'Paquete 50 unnombrecortoades'],
            ['nombrecorto'=>'SACO','nombre'=>'SACO'],
        ]);
    }
}


