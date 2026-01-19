<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $title = 'Dashboard User Tiket Asyik';
    protected $directory = 'user.dashboard';

    public function index()
    {
        $data['title'] = $this->title;

        // 1. Mengambil data acara terbaru (Tetap sama, ini untuk semua orang)
        $data['events'] = \App\Models\Acara::latest()->take(3)->get();

        // 2. BAGIAN INI YANG DIUBAH:
        // Kita cek, jika user sudah login (auth()->check()), ambil datanya.
        // Jika belum login, kita kasih collection kosong agar Blade tidak error.
        if (auth()->check()) {
            $data['orders'] = \App\Models\Pesanan::where('user_id', auth()->id())
                ->latest()
                ->get();
        } else {
            $data['orders'] = collect(); // Mengirim koleksi kosong untuk tamu
        }

        return view($this->directory . '.index', $data);
    }

    public function allEvents()
    {
        $data['title'] = 'Semua Destinasi Wisata';
        $data['events'] = \App\Models\Acara::latest()->paginate(9);

        // UBAH BARIS INI
        // Jangan pakai $this->directory, tulis langsung alamatnya
        return view('user.dashboard.all_events', $data);
    }
    public function nota($id)
    {
        // Kita ambil data Pesanan beserta relasi user, items, tipeTiket, dan acara
        // Pastikan di model TipeTiket sudah ada relasi bernama 'acara'
        $pesanan = \App\Models\Pesanan::with(['user', 'items.tipeTiket.acara'])->findOrFail($id);

        return view('user.dashboard.nota', [
            'title'   => 'Nota ' . $pesanan->kode_pesanan,
            'pesanan' => $pesanan
        ]);
    }
}
