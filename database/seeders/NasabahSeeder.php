<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Nasabah;
use Illuminate\Database\Seeder;

class NasabahSeeder extends Seeder
{
    public function run(): void
    {
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $status = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];

        // Create 50 sample nasabah
        for ($i = 1; $i <= 10; $i++) {
            // Create user first
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => bcrypt('password'),
                'telephone' => fake()->unique()->phoneNumber(),
                'role' => 'nasabah'
            ]);

            // Create nasabah data
            Nasabah::create([
                'user_id' => $user->id,
                'nama_lengkap' => $user->name,
                'nik' => fake()->unique()->numerify('################'),
                'telephone' => $user->telephone,
                'email' => $user->email,
                'tempat_lahir' => fake()->city(),
                'tanggal_lahir' => fake()->date(),
                'jenis_kelamin' => fake()->randomElement(['L', 'P']),
                'pekerjaan' => fake()->jobTitle(),
                'alamat_kantor_usaha' => fake()->address(),
                'agama' => fake()->randomElement($agama),
                'rt_rw' => fake()->numerify('###/###'),
                'dsn' => 'Dusun ' . fake()->word(),
                'ds' => 'Desa ' . fake()->word(),
                'kec' => 'Kec. ' . fake()->word(),
                'kab' => 'Kab. ' . fake()->word(),
                'kode_pos' => fake()->postcode(),
                'status_perkawinan' => fake()->randomElement($status),
            ]);
        }
    }
}
