<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoCajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('producto_cajas')->delete();

        \DB::table('producto_cajas')->insert([
            ['id'=>'CAJA250','nombre'=>'CAJA 250 '],
            ['id'=>'CAJA100','nombre'=>'CAJA 100'],
            ['id'=>'CAJA125','nombre'=>'CAJA 125'],
            ['id'=>'CAJA500','nombre'=>'CAJA 500'],
            ['id'=>'CAJ300x4mm','nombre'=>'Cajas con 300 rollos x 4 mm'],
            ['id'=>'CAJ300x6mm','nombre'=>'Cajas con 300 rollos x 6 mm'],
            ['id'=>'CAJ300x12mm','nombre'=>'Cajas con 300 rollos x 12 mm'],
            ['id'=>'CAJ300x15mm','nombre'=>'Cajas con 300 rollos x 15 mm'],
            ['id'=>'CAJ300x20mm','nombre'=>'Cajas con 300 rollos x 20 mm'],
            ['id'=>'CAJ300x25mm','nombre'=>'Cajas con 300 rollos x 25 mm'],
            ['id'=>'BOL1000','nombre'=>'bolsa: 1000 unidades'],
            ['id'=>'PAQ50','nombre'=>'Paquete 50 unidades'],
            ['id'=>'SACO','nombre'=>'SACO'],
        ]);
    }
}


