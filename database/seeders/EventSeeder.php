<?php

use App\Models\Admin;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua ID admin
        $adminIds = Admin::pluck('id_admin')->toArray();

        // Buat 10 data event
        Event::factory()->count(10)->create([
            // Pilih salah satu admin ID secara acak untuk mengisi admin_id
            'admin_id' => function () use ($adminIds) {
                return $adminIds[array_rand($adminIds)];
            },
        ]);
    }
}