<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel pesanan
            // Kita menggunakan 'id_pesanan' sebagai rujukan karena itu nama primary key di tabel pesanan kamu
            $table->foreignId('pesanan_id')
                  ->constrained('pesanan', 'id_pesanan')
                  ->onDelete('cascade');
            
            $table->decimal('jumlah_bayar', 15, 2);
            $table->string('metode_pembayaran')->nullable(); // Contoh: Transfer, OVO, Dana
            $table->string('status_pembayaran', 50)->default('pending'); // pending, sukses, gagal
            $table->string('bukti_pembayaran')->nullable(); // Untuk menyimpan nama file foto/gambar
            $table->timestamp('tanggal_bayar')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};