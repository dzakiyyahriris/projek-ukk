<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    // Karena nama tabel kita jamak (pembayarans), Laravel otomatis mengenalinya.
    // Tapi kita perlu mendefinisikan kolom mana saja yang boleh diisi (mass assignable).
    protected $fillable = [
        'pesanan_id',
        'jumlah_bayar',
        'metode_pembayaran', // Akan berisi 'cash' atau 'transfer'
        'status_pembayaran',
        'bukti_pembayaran',   // Hanya diisi jika transfer
        'tanggal_bayar'
    ];

    // Relasi balik ke Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id_pesanan');
    }
}
