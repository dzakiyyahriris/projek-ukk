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
    Schema::table('acara', function (Blueprint $table) {
        // Cek dulu: Jika kolom 'stok' TIDAK ADA, baru ditambahkan
        if (!Schema::hasColumn('acara', 'stok')) {
            $table->integer('stok')->default(100)->after('nama');
        }
    });
}

public function down()
{
    Schema::table('acara', function (Blueprint $table) {
        $table->dropColumn('stok');
    });
}
};
