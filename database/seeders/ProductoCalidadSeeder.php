<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoCalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vonombrecorto
     */
    public function run()
    {
        \DB::table('producto_calidades')->delete();

        \DB::table('producto_calidades')->insert([
            ['nombrecorto'=>'LON_2C','nombre'=>'LONA 2 CARAS'],
            ['nombrecorto'=>'ADH_CRI','nombre'=>'ADH CRISTAL'],
            ['nombrecorto'=>'ADH_NOR','nombre'=>'ADH NORMAL'],
            ['nombrecorto'=>'ADH','nombre'=>'ADHESIVOS'],
            ['nombrecorto'=>'ALU','nombre'=>'ALU'],
            ['nombrecorto'=>'ANTIGRAFIT','nombre'=>'ANTIGRAFIT'],
            ['nombrecorto'=>'BACKLIGHT','nombre'=>'BACKLIGHT'],
            ['nombrecorto'=>'BRILLO','nombre'=>'BRILLO'],
            ['nombrecorto'=>'CAR','nombre'=>'CAR'],
            ['nombrecorto'=>'ESP','nombre'=>'ESPECIAL'],
            ['nombrecorto'=>'ESTC_BRILL','nombre'=>'ESTC BRILL'],
            ['nombrecorto'=>'ESTC_MATE','nombre'=>'ESTC MATE'],
            ['nombrecorto'=>'FOA','nombre'=>'FOA'],
            ['nombrecorto'=>'LON','nombre'=>'LONA'],
            ['nombrecorto'=>'MAG','nombre'=>'MAGNETICO'],
            ['nombrecorto'=>'MAT','nombre'=>'MATE'],
            ['nombrecorto'=>'MET','nombre'=>'MET'],
            ['nombrecorto'=>'Nid','nombre'=>'Nid'],
            ['nombrecorto'=>'OFF_BL','nombre'=>'OFFSET BL'],
            ['nombrecorto'=>'OTR','nombre'=>'OTR'],
            ['nombrecorto'=>'PAP','nombre'=>'PAPEL'],
            ['nombrecorto'=>'PLA','nombre'=>'PLASTICOS'],
            ['nombrecorto'=>'PP_','nombre'=>'PP_'],
            ['nombrecorto'=>'PVC','nombre'=>'PVC'],
            ['nombrecorto'=>'REC','nombre'=>'RECICLADOS'],
            ['nombrecorto'=>'SAT','nombre'=>'SATIN'],
            ['nombrecorto'=>'STO_L','nombre'=>'STOPLIGHT'],
            ['nombrecorto'=>'TXTIL','nombre'=>'TEXTIL'],
            ['nombrecorto'=>'TXTURA','nombre'=>'TEXTURA'],
            ['nombrecorto'=>'VIN','nombre'=>'VINILO'],
            ['nombrecorto'=>'WIN','nombre'=>'WINDOWS'],
        ]);
    }
}

