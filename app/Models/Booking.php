<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings'; // Pastikan nama tabel benar

    protected $fillable = [
        'user_id',
        'event_id',
        'ticket_type_id',
        'tanggal_kunjungan',
        'jumlah_tiket',
        'total_harga',
        'status',
    ];

    // Relasi (Opsional tapi berguna)
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Acara::class, 'event_id', 'id_event');
    }

    public function tipeTiket() {
        return $this->belongsTo(TipeTiket::class, 'ticket_type_id', 'id_ticket_type');
    }
}