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

        User::factory()->create([
            'name' => 'Admin',
            'npm_nim_nis' => '123',
            'email' => 'admin@example.com',
            'email_verified_at' => now(), 
            'password' => bcrypt('123'),
        ]);

        User::factory()->create([
            'name' => 'Pembimbing',
            'npm_nim_nis' => '1234',
            'email' => 'pembimbing@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'),
        ]);

        User::factory()->create([
            'name' => 'User',
            'npm_nim_nis' => '12345',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
        ]);
    }
}
