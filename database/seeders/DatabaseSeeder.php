<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mobil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->create();
        //$this->call(BukukasSeeder::class);
        User::create([
            'name' => 'Muhamad Sanda Narotama',
            'username' => 'Sanda',
            'role' => 'admin',
            'email'=> 'sandanarotama362@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'role' => 'owner',
            'email'=> 'Admin@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        User::create([
            'name' => 'User',
            'username' => 'User',
            'role' => 'user',
            'email'=> 'user@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        Mobil::create([
            'nopol' => 'F 1974 PE',
            'jurusan' => 'Cicurug',
        ]);

        Mobil::create([
            'nopol' => 'F 1929 RL',
            'jurusan' => 'Cicurug',
        ]);
        Mobil::create([
            'nopol' => 'F 1994 PC',
            'jurusan' => 'Cicurug',
        ]);
        //Bukukas::factory()->count(50)->create();


    }
}
