<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Bukukas;
use App\Models\User;
use App\Models\Mobil;

class BukukasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua user dan mobil yang ada di database
        $users = User::all();
        $mobils = Mobil::all();

        // Loop untuk membuat data bukukas
        foreach (range(1, 50) as $index) {
            $bukukas = new Bukukas;
            $bukukas->masuk = $faker->randomFloat(2, 100, 1000);
            $bukukas->keluar = $faker->randomFloat(2, 100, 500);
            $bukukas->uraian = $faker->sentence;
            $bukukas->tanggal = $faker->dateTimeBetween('-1 year', 'now');

            // Ambil random user dan mobil
            $randomUser = $users->random();
            $randomMobil = $mobils->random();

            // Assign user_id dan mobil_id secara random
            $bukukas->user_id = $randomUser->id;
            $bukukas->mobil_id = $randomMobil->id;

            $bukukas->save();
        }
    }
}
