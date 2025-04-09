<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        //     'telephone' => '081234567890',
        //     'role' => 'admin',
        //     'password' => bcrypt('password'),
        // ]);

        // User::factory()->create([
        //     'name' => 'Marketing',
        //     'email' => 'marketing@example.com',
        //     'telephone' => '081234567894',
        //     'role' => 'marketing',
        //     'password' => bcrypt('password'),
        // ]);

        User::factory()->create([
            'name' => 'Manajer',
            'email' => 'manajer@example.com',
            'telephone' => '081234567899',
            'role' => 'manajer',
            'password' => bcrypt('password'),
        ]);

        // $this->call([
        //     NasabahSeeder::class,
        // ]);
    }
}
