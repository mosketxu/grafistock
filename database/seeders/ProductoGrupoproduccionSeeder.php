<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoGrupoproduccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('producto_gruposproduccion')->delete();

        \DB::table('producto_gruposproduccion')->insert([
            ['id'=>'CON','nombre'=>'CONSUMIB'],
            ['id'=>'EMB','nombre'=>'EMBALAJES'],
            ['id'=>'GEXP','nombre'=>'G EXPOSITO'],
            ['id'=>'GLAMADH','nombre'=>'G LAM ADH'],
            ['id'=>'GSOPFOT','nombre'=>'G SOP FOTO'],
            ['id'=>'GSOPRIG','nombre'=>'G SOP RIGI'],
            ['id'=>'GSOPROL','nombre'=>'G SOP ROLL'],
            ['id'=>'GTINT','nombre'=>'G TINTAS'],
            ['id'=>'GVINCOR','nombre'=>'G VIN CORT'],
            ['id'=>'PACAB','nombre'=>'P ACABADOS'],
            ['id'=>'PPAP','nombre'=>'P PAPEL'],
        ]);
    }
}

