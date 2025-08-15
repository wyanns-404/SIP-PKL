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
        $this->call(ShieldSeeder::class);

        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'npm_nim_nis' => '123',
            'email' => 'super-admin@example.com',
            'email_verified_at' => now(), 
            'password' => bcrypt('123'),
        ]);
        $superAdmin->assignRole('super_admin');

        $admin = User::factory()->create([
            'name' => 'Admin',
            'npm_nim_nis' => '1234',
            'email' => 'admin@example.com',
            'email_verified_at' => now(), 
            'password' => bcrypt('123'),
        ]);
        $admin->assignRole('admin');

        $user = User::factory()->create([
            'name' => 'User',
            'npm_nim_nis' => '12345',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
        ]);
        $user->assignRole('user');
    }
}
