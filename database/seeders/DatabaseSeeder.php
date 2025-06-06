<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cage;
use App\Models\Animal;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        Cage::factory()->count(10)->create();
        Animal::factory()->count(30)->create();
    }
}
