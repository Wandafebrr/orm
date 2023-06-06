<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Mahasiswa::create([
                'Nim' => $faker->numberBetween(0001, 9999),
                'Nama' => $faker->name,
                'ttl' => $faker->date,
                'Kelas' => $faker->randomElement(['2A', '2B', '2C','1A','1B','1C','3A','3B']),
                'Jurusan' => $faker->randomElement(['Teknik Informatika', 'Sistem Informasi']),
                'No_Handphone' => $faker->phoneNumber,
                'Email' => $faker->unique()->email,
            ]);
        }
    }
}
