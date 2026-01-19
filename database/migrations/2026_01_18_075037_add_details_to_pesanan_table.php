<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pesanan', function (Blueprint $table) {
            // Kita tambahkan kolom yang hilang
            $table->unsignedBigInteger('id_wisata')->nullable()->after('user_id'); // Untuk wisata_id
            $table->unsignedBigInteger('id_ticket_type')->nullable()->after('id_wisata');
            $table->date('tanggal_kunjungan')->nullable()->after('id_ticket_type');
            $table->integer('jumlah_tiket')->default(1)->after('tanggal_kunjungan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            //
        });
    }
};
