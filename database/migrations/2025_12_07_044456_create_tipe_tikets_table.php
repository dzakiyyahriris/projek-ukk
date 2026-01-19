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
        Schema::create('tipe_tiket', function (Blueprint $table) {
            $table->id('id_ticket_type');
            // Foreign key ke tabel 'acara'
            $table->unsignedBigInteger('event_id'); 
            $table->string('nama', 100);
            $table->decimal('harga', 10, 2);
            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('event_id')->references('id_event')->on('acara')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_tiket');
    }
};