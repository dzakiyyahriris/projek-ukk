<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Hapus tabel lama jika nyangkut
        Schema::dropIfExists('transactions');

        // 2. Buat tabel baru
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // ID Transaksi
            
            // Relasi ke User (Standar)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // --- BAGIAN RELASI KE ACARA (DIPERBAIKI) ---
            // Kita siapkan kolomnya dulu
            $table->unsignedBigInteger('wisata_id'); 
            
            // Kita sambungkan secara manual:
            // "Kolom 'wisata_id' merujuk ke kolom 'id_event' di tabel 'acara'"
            $table->foreign('wisata_id')
                  ->references('id_event') // Sesuai ID di tabel acara kamu
                  ->on('acara')            // Sesuai nama tabel kamu (tanpa s)
                  ->onDelete('cascade');
            // -------------------------------------------

            $table->date('tanggal_kunjungan');
            $table->integer('jumlah_tiket');
            $table->decimal('total_harga', 15, 2);
            $table->enum('status', ['pending', 'success', 'cancelled'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};