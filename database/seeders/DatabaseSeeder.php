<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Abu Bakar AB',
            'email' => 'abu.bakar@tylextech.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::factory(10)->create();
    }
}
