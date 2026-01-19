<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;

    // Nama tabel sesuai skema Anda
    protected $table = 'acara';

    // Primary key
    protected $primaryKey = 'id_event';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'admin_id',
        'nama',
        'tanggal',
        'harga',  // Pastikan ini ada
        'stok',   // Pastikan ini ada, sesuaikan jika namanya 'stok_tiket'
        'image_path'
    ];

    // Kolom yang harus di-cast ke tipe data tertentu
    protected $casts = [
        'tanggal' => 'datetime',
    ];

    /**
     * Relasi: Sebuah acara dimiliki oleh satu admin (User).
     */
    public function admin()
    {
        // Menggunakan 'admin_id' sebagai foreign key dan 'id' pada tabel 'users'
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function tipeTiket()
    {
        return $this->hasMany(TipeTiket::class, 'event_id', 'id_event');
    }
}
