<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin utama
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@tiketasyikk.com',
            'password' => Hash::make('password'),
            'role' => 'admin', // Wajib untuk multi-role
        ]);

        // 5 Admin dummy (jika diperlukan)
        User::factory()->count(5)->create([
            'role' => 'admin', // Set role admin agar tidak jadi user biasa
        ]);
    }
}
