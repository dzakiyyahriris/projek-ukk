<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan Anda menggunakan Model yang benar

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin Utama
        DB::table('users')->insert([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang kuat
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Pengguna Biasa 1
        DB::table('users')->insert([
            'name' => 'Pengguna Satu',
            'email' => 'user1@example.com',
            'role' => 'user',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 3. Pengguna Biasa 2
        DB::table('users')->insert([
            'name' => 'Pengguna Dua',
            'email' => 'user2@example.com',
            'role' => 'user',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Anda juga bisa menggunakan Factory untuk membuat lebih banyak data pengguna
        // User::factory(10)->create(); 
    }
}