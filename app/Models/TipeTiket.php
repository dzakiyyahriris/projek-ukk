<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeTiket extends Model
{
    use HasFactory;

    protected $table = 'tipe_tiket';

    // INI KUNCINYA: Memberitahu Laravel bahwa ID tabel ini bernama 'id_ticket_type'
    protected $primaryKey = 'id_ticket_type';

    protected $fillable = [
        'event_id',
        'nama_tipe', // CEK DATABASE ANDA: Apakah 'nama' atau 'nama_tipe'? Sesuaikan di sini.
        'harga',
        'stok',
    ];

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'event_id', 'id_event');
    }
}
