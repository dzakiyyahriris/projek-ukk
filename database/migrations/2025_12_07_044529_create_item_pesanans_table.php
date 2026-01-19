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
        Schema::create('item_pesanan', function (Blueprint $table) {
            $table->id('id_item_pesanan');
            // Foreign key ke tabel 'pesanan'
            $table->unsignedBigInteger('order_id'); 
            // Foreign key ke tabel 'tipe_tiket'
            $table->unsignedBigInteger('ticket_type_id'); 
            $table->string('kode_tiket', 100)->unique();
            $table->string('status');
            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('order_id')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
            $table->foreign('ticket_type_id')->references('id_ticket_type')->on('tipe_tiket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_pesanan');
    }
};