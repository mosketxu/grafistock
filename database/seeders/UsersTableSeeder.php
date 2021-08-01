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

        User::factory(9)->create();

    }
}
