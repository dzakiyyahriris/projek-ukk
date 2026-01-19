<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */ public function up()
    {
        Schema::table('tipe_tiket', function (Blueprint $table) {
            // Menambahkan kolom stok, integer, default 0
            $table->integer('stok')->default(0)->after('harga');
        });
    }

    public function down()
    {
        Schema::table('tipe_tiket', function (Blueprint $table) {
            $table->dropColumn('stok');
        });
    }
};
