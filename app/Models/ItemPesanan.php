<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPesanan extends Model
{
    use HasFactory;

    protected $table = 'item_pesanan';
    protected $primaryKey = 'id_item_pesanan';

    protected $fillable = [
        'order_id',
        'ticket_type_id',
        'kode_tiket',
        'status',
    ];

    // Relasi ke Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'order_id', 'id_pesanan');
    }

    // =========================================================
    // PERBAIKAN: SAYA GANTI NAMANYA JADI 'tiket'
    // AGAR SESUAI DENGAN CONTROLLER: with('items.tiket')
    // =========================================================
    public function tiket()
    {
        // Pastikan Model 'TipeTiket' ada.
        // Parameter 2: FK di tabel item_pesanan (ticket_type_id)
        // Parameter 3: PK di tabel tipe_tiket (id_ticket_type)
        return $this->belongsTo(TipeTiket::class, 'ticket_type_id', 'id_ticket_type');
    }
}
