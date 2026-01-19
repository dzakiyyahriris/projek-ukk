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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            // Foreign key ke tabel 'pengguna'
            $table->unsignedBigInteger('user_id'); 
            $table->string('kode_pesanan', 50)->unique();
            $table->decimal('jumlah_total', 10, 2);
            $table->string('status', 50);
            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};