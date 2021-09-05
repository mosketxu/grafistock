<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {

        \DB::table('users')->delete();

        User::create([
            'name' => 'Alexa',
            'email' => 'mosketxu@gmail.com',
            'password' => bcrypt('Braggelone'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Emilio Alvarez Martin',
            'email' => 'alvarezemilio2012@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Victor',
            'email' => 'victor@grafitex.net',
            'password' => bcrypt('12345678'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Jose Martin',
            'email' => 'josemartin@grafitex.net',
            'password' => bcrypt('12345678'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Operario',
            'email' => 'operario@grafitex.net',
            'password' => bcrypt('12345678'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Gestion',
            'email' => 'gestion@grafitex.net',
            'password' => bcrypt('12345678'),
        ])->assignRole('Gestion');


        // User::factory(9)->create();

    }
}
