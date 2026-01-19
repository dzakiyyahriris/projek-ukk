<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Acara;
use App\Models\TipeTiket;
use App\Models\ItemPesanan;

class DashboardController extends Controller
{
    // Variabel untuk data umum
    protected $title = 'Dashboard Admin Tiket Asyik'; // Diperbarui
    protected $menu = 'dashboard';
    protected $directory = 'admin.dashboard'; // Asumhsi: path view Anda adalah resources/views/admin/dashboard/index.blade.php

    public function index()
    {
        $data['title'] = $this->title;
        $data['menu']  = $this->menu;

        // ✅ STATISTIK UNTUK BOX (KOTAK-KOTAK ATAS)
        $data['total_admin'] = User::where('role', 'admin')->count();
        $data['total_acara'] = Acara::count();
        $data['total_pesanan'] = Pesanan::count(); // Total semua pesanan di sistem
        $data['total_pengguna_terdaftar'] = User::where('role', 'user')->count();

        // ✅ DATA TABEL UNTUK USER (PESANAN SAYA)
        // Mengambil pesanan milik user yang sedang login saja
        $data['pesanans'] = Pesanan::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view($this->directory . '.index', $data);
    }


    public function indexlama()
    {
        // 1. Menyiapkan array untuk dikirim ke view
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;

        // =========================================================
        // 2. LOGIKA PENGAMBILAN DATA METRIK TIKET
        // =========================================================

        // Metrik 1: Total Pengguna Terdaftar (Role: user)
        $data['total_pengguna_terdaftar'] = User::where('role', 'user')->count();

        // Metrik 2: Total Acara Aktif (Acara yang tanggalnya belum lewat)
        // Pastikan Anda sudah mengimpor model Acara
        $data['total_acara_aktif'] = Acara::whereDate('tanggal', '>=', now()->toDateString())->count();

        // Metrik 3: Pesanan Baru (Status: menunggu pembayaran)
        // Pastikan Anda sudah mengimpor model Pesanan
        $data['pesanan_baru'] = Pesanan::where('status', 'menunggu pembayaran')->count();

        // $data['total_pesanan'] = Pesanan::count();
        // $data['total_pesanan'] = \App\Models\Pesanan::count();


        // Metrik 4: Top 5 Tipe Tiket Terlaris
        // Pastikan relasi 'tipeTiket' sudah didefinisikan di Model ItemPesanan
        $data['top_ticket_types'] = ItemPesanan::select('ticket_type_id')
            ->selectRaw('COUNT(*) as total_terjual')
            ->groupBy('ticket_type_id')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->with(['tipeTiket'])
            ->get();

        // Catatan: Jika Anda ingin menambahkan Total Pendapatan Bulan Ini, Anda perlu model Pesanan dan query SUM()
        // $data['total_pendapatan_bulan_ini'] = Pesanan::where('status', 'lunas')
        //     ->whereMonth('created_at', now()->month)
        //     ->sum('jumlah_total');

        // =========================================================

        // Me-return view beserta data
        return view($this->directory . '.index', $data);
    }

    // Anda mungkin memiliki metode profile() di sini
    public function profile()
    {
        // ...
    }
}
