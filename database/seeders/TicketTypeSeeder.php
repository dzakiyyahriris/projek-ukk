<?php

use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua event yang sudah dibuat
        $events = Event::all();

        foreach ($events as $event) {
            // Untuk setiap event, buat antara 2 hingga 4 jenis tiket
            TicketType::factory()->count(rand(2, 4))->create([
                'event_id' => $event->id_event,
            ]);
        }
    }
}