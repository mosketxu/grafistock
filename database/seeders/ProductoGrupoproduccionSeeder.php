<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoGrupoproduccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vonombrecorto
     */
    public function run()
    {
        \DB::table('producto_gruposproduccion')->delete();

        \DB::table('producto_gruposproduccion')->insert([
            ['nombrecorto'=>'CON','nombre'=>'CONSUMIB'],
            ['nombrecorto'=>'EMB','nombre'=>'EMBALAJES'],
            ['nombrecorto'=>'GEXP','nombre'=>'G EXPOSITO'],
            ['nombrecorto'=>'GLAMADH','nombre'=>'G LAM ADH'],
            ['nombrecorto'=>'GSOPFOT','nombre'=>'G SOP FOTO'],
            ['nombrecorto'=>'GSOPRIG','nombre'=>'G SOP RIGI'],
            ['nombrecorto'=>'GSOPROL','nombre'=>'G SOP ROLL'],
            ['nombrecorto'=>'GTINT','nombre'=>'G TINTAS'],
            ['nombrecorto'=>'GVINCOR','nombre'=>'G VIN CORT'],
            ['nombrecorto'=>'PACAB','nombre'=>'P ACABADOS'],
            ['nombrecorto'=>'PPAP','nombre'=>'P PAPEL'],
        ]);
    }
}

