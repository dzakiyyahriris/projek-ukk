<?php

use App\Models\Pesanan;
use App\Models\User;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class PesananSeeder extends Seeder
{
    public function run()
    {
        $userIds = User::pluck('id_user')->toArray();
        $ticketTypes = TicketType::all();

        // Buat 10 hingga 20 pesanan
        Pesanan::factory()->count(rand(10, 20))->make()->each(function ($pesanan) use ($userIds, $ticketTypes) {
            
            // 1. Tetapkan user_id
            $pesanan->user_id = $userIds[array_rand($userIds)];
            $pesanan->save();

            // 2. Tentukan jenis tiket yang dibeli (pivot table Item Pesanan)
            $itemsToBuy = $ticketTypes->random(rand(1, 3)); // Beli 1-3 jenis tiket berbeda

            $totalHarga = 0;
            $itemPesananData = [];

            foreach ($itemsToBuy as $ticketType) {
                $jumlah = rand(1, 4); // Jumlah tiket yang dibeli
                $subtotal = $jumlah * $ticketType->harga;
                $totalHarga += $subtotal;

                // Siapkan data untuk tabel pivot/tabel Item Pesanan
                $itemPesananData[$ticketType->id_ticket_type] = [
                    'jumlah_total' => $jumlah, // Mengisi kolom jumlah_total di tabel Item Pesanan
                    'kode_tiket' => 'TICKET-' . strtoupper(Str::random(10)), // Kode tiket dummy
                    'status' => 'issued', // Status Item Pesanan
                ];
            }

            // 3. Simpan data ke tabel pivot (Item Pesanan)
            $pesanan->ticketTypes()->attach($itemPesananData);

            // 4. Update total harga di tabel Pesanan
            $pesanan->update([
                'jumlah_total' => $totalHarga,
                'status' => 'paid', // Set status ke sudah bayar
            ]);
        });
    }
}