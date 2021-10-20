<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmpresaTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('empresa_tipos')->delete();

        \DB::table('empresa_tipos')->insert([
            ['nombre' => 'Gran Empresa','nombrecorto' => 'A','factormaterial'=>'1.1','preciotintamin'=>'10'],
            ['nombre' => 'Mediana Empresa','nombrecorto' => 'B','factormaterial'=>'1.2','preciotintamin'=>'15'],
            ['nombre' => 'Pequeña Empresa','nombrecorto' => 'C','factormaterial'=>'1.3','preciotintamin'=>'20'],
            ['nombre' => 'Mini Empresa','nombrecorto' => 'D','factormaterial'=>'1.4','preciotintamin'=>'25'],
            ['nombre' => 'Micro Empresa','nombrecorto' => 'E','factormaterial'=>'1.5','preciotintamin'=>'30'],
        ]);    }
}
