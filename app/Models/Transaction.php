<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Acara; // Panggil Model Acara

class Transaction extends Model
{
    use HasFactory;

    // GUARDED: Artinya semua kolom BOLEH diisi KECUALI 'id'
    // Jadi 'tanggal_kunjungan' otomatis aman.
    protected $guarded = ['id'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Wisata (Acara)
    public function wisata()
    {
        // Parameter: (ModelTujuan, KeyDiTabelIni, KeyDiTabelSana)
        return $this->belongsTo(Acara::class, 'wisata_id', 'id_event');
    }
}