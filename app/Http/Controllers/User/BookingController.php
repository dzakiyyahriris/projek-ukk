<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Acara;
use App\Models\TipeTiket;
use App\Models\Pesanan;
// Hapus use App\Models\ItemPesanan jika tidak dipakai
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    // --- PERBAIKAN DI SINI ---
    // Ubah 'showBookingForm' menjadi 'index' agar sesuai dengan error Route
    public function index($id)
    {
        // Ambil data acara beserta tipe tiketnya
        $event = Acara::with('tipeTiket')->findOrFail($id);

        $data = [
            'title' => 'Booking Tiket - ' . $event->nama,
            'event' => $event
        ];

        // Pastikan file view Anda ada di: resources/views/user/dashboard/booking.blade.php
        return view('user.dashboard.booking', $data);
    }

    public function storeOrder(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'wisata_id' => 'required',
            'tanggal_kunjungan' => 'required|date',
            'ticket_type_id' => 'required|numeric',
            'jumlah' => 'required|numeric|min:1',
        ]);

        // 2. Ambil Info Tiket
        $tipeTiket = TipeTiket::find($request->ticket_type_id);

        if (!$tipeTiket) {
            return back()->with('error', 'Tiket tidak valid.');
        }

        $totalBayar = $tipeTiket->harga * $request->jumlah;

        // 3. Simpan Pesanan
        $pesanan = new Pesanan();

        // -- Data Wajib --
        $pesanan->user_id = auth()->id();
        $pesanan->kode_pesanan = 'ORD-' . strtoupper(uniqid());
        $pesanan->status = 'pending';

        // -- Data Keuangan --
        $pesanan->jumlah_total = $totalBayar;

        // -- Data Detail --
        $pesanan->id_wisata = $request->wisata_id;
        $pesanan->id_ticket_type = $request->ticket_type_id;
        $pesanan->tanggal_kunjungan = $request->tanggal_kunjungan;
        $pesanan->jumlah_tiket = $request->jumlah;

        $pesanan->save();

        // 4. Redirect
        return redirect()->route('user.dashboard')->with('success', 'Booking Berhasil!');
    }
}
