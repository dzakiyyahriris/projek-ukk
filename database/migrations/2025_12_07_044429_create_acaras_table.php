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
        Schema::create('acara', function (Blueprint $table) {
            $table->id('id_event');
            // Foreign key ke tabel 'pengguna' (id_pengguna)
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('admin_id'); 
            $table->string('nama', 255);
            $table->dateTime('tanggal');
            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acara');
    }
};