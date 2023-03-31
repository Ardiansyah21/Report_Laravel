<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\user;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nazril',
            'email' => 'Nazril@gmail.com',
            'password' => bcrypt('nazril'),
            'role' => 'admin'

        ]);

        User::create([
            'name' => 'Petugas',
            'email' => 'Petugas@gmail.com',
            'password' => bcrypt('petugas'),
            'role' => 'petugas'

        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
