<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan; // Sesuaikan dengan model utama Anda
use App\Models\Acara;
use Illuminate\Support\Str;

class UserOrderController extends Controller
{
    // 1. Menampilkan Riwayat Pesanan (Halaman Tiket Saya)
    public function index()
    {
        // PERBAIKAN:
        // Ganti 'items.tipeTiket.acara' menjadi 'acara' dan 'tipeTiket'
        // Karena data tersimpan langsung di tabel pesanan
        $orders = \App\Models\Pesanan::with(['acara', 'tipeTiket'])
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->where('status', 'Lunas')
            ->latest()
            ->get();

        return view('user.orders', compact('orders'));
    }
    // 2. Menampilkan Formulir Beli Tiket
    public function create()
    {
        $acaras = Acara::all();
        return view('user.create', compact('acaras'));
    }

    // 3. Proses Simpan Pesanan
    public function store(Request $request)
    {
        $request->validate([
            'wisata_id' => 'required',
            'jumlah_tiket' => 'required|integer|min:1',
            'total_harga' => 'required',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
        ]);

        // Simpan ke tabel pesanan
        $pesanan = Pesanan::create([
            'id_user'           => Auth::id(),
            'kode_pesanan'      => 'ORD-' . strtoupper(Str::random(10)),
            'jumlah_total'      => $request->total_harga,
            'status'            => 'pending',
            'metode_pembayaran' => 'transfer', // default
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
        ]);

        // Catatan: Jika Anda menggunakan sistem ItemPesanan, 
        // Anda juga harus melakukan insert ke tabel item_pesanan di sini.

        return redirect()->route('user.orders')->with('success', 'Tiket berhasil dipesan! Silakan selesaikan pembayaran.');
    }
}
