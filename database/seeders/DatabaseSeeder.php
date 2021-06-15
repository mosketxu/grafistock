<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $this->call(MetodoPagosTableSeeder::class);
        $this->call(PaisesTableSeeder::class);
        $this->call(ProvinciasTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UnidadSeeder::class);
        $this->call(MaterialesSeeder::class);
        $this->call(UbicacionesSeeder::class);
        $this->call(SeccionSeeder::class);
        $this->call(SolicitanteSeeder::class);
    }
}
