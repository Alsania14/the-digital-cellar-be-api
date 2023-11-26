<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            \App\Models\User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
            ]);
            \App\Models\User::factory()->count(50)->create();
        } catch (\Throwable $th) {
            echo ">> User already exists.\n\n";
        }
    }
}
