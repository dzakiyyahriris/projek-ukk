<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    // 1. Tampilkan Halaman Utama
    public function index()
    {
        return view('admin.checkin.index');
    }

    // 2. Tahap Pencarian & Validasi Awal
    public function check(Request $request)
    {
        $request->validate([
            'kode_tiket' => 'required|string'
        ]);

        // Cari pesanan berdasarkan kode (pastikan kolom sesuai: kode_pesanan atau kode_tiket)
        $pesanan = Pesanan::where('kode_pesanan', $request->kode_tiket)->first();

        if (!$pesanan) {
            return redirect()->route('admin.checkin.index')->with('error', 'Tiket TIDAK DITEMUKAN!');
        }

        // Jika sudah lunas dan belum dipakai, bisa langsung check-in
        if ($pesanan->status === 'Lunas' || $pesanan->status === 'lunas') {
            if ($pesanan->status_tiket === 'sudah_dipakai') {
                return redirect()->route('admin.checkin.index')->with('error', 'Tiket SUDAH DIPAKAI sebelumnya.');
            }

            // Langsung Check-in
            $pesanan->update(['status_tiket' => 'sudah_dipakai']);
            return redirect()->route('admin.checkin.index')->with('success', 'Check-in BERHASIL! Tiket sudah lunas sebelumnya.');
        }

        // JIKA STATUS: 'bayar di loket', kirim data ke view untuk simulasi kasir
        if ($pesanan->status === 'bayar di loket') {
            return view('admin.checkin.index', compact('pesanan'));
        }

        return redirect()->route('admin.checkin.index')->with('error', 'Status tiket tidak valid (' . $pesanan->status . ')');
    }

    // 3. Tahap Konfirmasi Pembayaran & Check-in Sekaligus
    public function processPayment(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Admin menerima uang tunai di sini
        $pesanan->update([
            'status' => 'Lunas', // Di sinilah status berubah jadi Lunas
            'status_tiket' => 'sudah_dipakai',
            'checkin_at' => now(),
            'admin_id' => auth()->id()
        ]);

        return redirect()->route('admin.checkin.index')->with('success', 'Pembayaran diterima dan tiket telah divalidasi!');
    }
}
