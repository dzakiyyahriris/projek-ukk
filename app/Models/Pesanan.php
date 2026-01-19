<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Hapus use App\Models\ItemPesanan; karena tidak dipakai lagi
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Acara;     // Tambahkan ini
use App\Models\TipeTiket; // Tambahkan ini

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'user_id',           // Sesuaikan dengan BookingController (biasanya user_id)
        'kode_pesanan',
        'jumlah_total',
        'status',
        // Tambahan kolom baru (Sesuai BookingController)
        'id_wisata',
        'id_ticket_type',
        'tanggal_kunjungan',
        'jumlah_tiket'
    ];

    // =========================================================
    // RELASI UTAMA (PENTING)
    // =========================================================

    // 1. Relasi ke User
    public function user()
    {
        // Pastikan parameter ke-2 sesuai nama kolom di DB (user_id atau id_user)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // 2. Relasi ke Acara / Wisata (PENGGANTI ITEMS)
    // Karena id_wisata sekarang ada di tabel pesanan, kita pakai belongsTo
    public function acara()
    {
        return $this->belongsTo(Acara::class, 'id_wisata', 'id_event'); // Cek primary key acara (id atau id_event)
    }

    // 3. Relasi ke Tipe Tiket
    // Relasi ke Tipe Tiket
    public function tipeTiket()
    {
        // Parameter 2 ('id_ticket_type'): Nama kolom Foreign Key di tabel PESANAN
        // Parameter 3 ('id_ticket_type'): Nama kolom Primary Key di tabel TIPE_TIKET

        return $this->belongsTo(TipeTiket::class, 'id_ticket_type', 'id_ticket_type');
    }
    // 4. Relasi ke Pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pesanan_id', 'id_pesanan');
    }
}
