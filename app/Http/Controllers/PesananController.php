<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

// Import Model
use App\Models\Pesanan;
use App\Models\ItemPesanan;
use App\Models\User;
use App\Models\TipeTiket;
use App\Models\Acara;

class PesananController extends Controller
{
    protected $title = 'Pesanan Tiket';

    /**
     * Tampilkan daftar pesanan
     */
    public function index(Request $request)
    {
        $title = 'Pesanan Tiket';
        $user = Auth::user();

        // JIKA ADMIN: Tampilkan semua pesanan
        if ($user->role == 'admin') {
            $query = Pesanan::with('user');

            if ($request->has('tanggal') && $request->tanggal != null) {
                $query->whereDate('created_at', $request->tanggal);
            }

            $pesanan = $query->orderBy('created_at', 'desc')->get();
            return view('admin.pesanan.index', compact('pesanan', 'title'));
        }

        // JIKA USER: Tampilkan pesanan miliknya sendiri
        else {
            // PERBAIKAN: Gunakan 'itemPesanan' (sesuai Model Pesanan.php)
            // Pastikan model ItemPesanan punya relasi ke 'tiket' (atau tipeTiket)
            $orders = Pesanan::with(['itemPesanan.tiket'])
                ->where('id_user', Auth::id()) // Pastikan kolom user di tabel pesanan adalah id_user
                ->latest()
                ->get();

            return view('user.orders', compact('orders', 'title'));
        }
    }

    public function create()
    {
        $pelanggan = User::where('role', 'user')->get(['id', 'name', 'email']);
        $tipeTiket = TipeTiket::with('acara')
            ->get(['id_ticket_type', 'nama', 'harga', 'event_id']);

        return view('admin.pesanan.create', [
            'title' => $this->title,
            'pelanggan' => $pelanggan,
            'tipeTiket' => $tipeTiket,
        ]);
    }

    /**
     * Simpan pesanan
     */
    public function store(Request $request)
    {
        // 1. VALIDASI
        $request->validate([
            'user_id'              => 'required|exists:users,id',
            'items'                => 'required|array|min:1',
            'items.*.ticket_type_id' => 'required|exists:tipe_tiket,id_ticket_type',
            'items.*.jumlah_tiket' => 'required|integer|min:1',
            'metode_pembayaran'    => 'required|in:cash,transfer',
        ]);

        $itemsData  = $request->items;
        $totalHarga = 0;
        $totalTiket = 0;

        // Ambil data tipe tiket dari DB
        $listTipeTiket = TipeTiket::with('acara')
            ->whereIn('id_ticket_type', array_column($itemsData, 'ticket_type_id'))
            ->get()
            ->keyBy('id_ticket_type');

        // 2. HITUNG TOTAL & CEK STOK
        foreach ($itemsData as $item) {
            $ticketId = $item['ticket_type_id'];
            $jumlah   = (int) $item['jumlah_tiket'];

            if (!$listTipeTiket->has($ticketId)) {
                return back()->withInput()->with('error', 'Tipe tiket tidak valid.');
            }

            $tipeTiket = $listTipeTiket[$ticketId];
            $totalHarga += $tipeTiket->harga * $jumlah;
            $totalTiket += $jumlah;
        }

        // Cek Stok (Asumsi 1 transaksi = 1 event)
        $firstTicket = $listTipeTiket[$itemsData[0]['ticket_type_id']];
        $acara = $firstTicket->acara;

        if (!$acara) {
            return back()->with('error', 'Data Acara tidak ditemukan.');
        }

        if ($acara->stok < $totalTiket) {
            return back()->withInput()->with('error', "Stok tidak cukup! Sisa: {$acara->stok}");
        }

        // 3. TENTUKAN STATUS AWAL
        $statusAwal = ($request->metode_pembayaran == 'cash') ? 'Lunas' : 'Menunggu Verifikasi';

        DB::beginTransaction();

        try {
            // A. BUAT PESANAN UTAMA
            $pesanan = Pesanan::create([
                'id_user'      => $request->user_id, // Sesuaikan dengan kolom database (id_user/user_id)
                'kode_pesanan' => 'ORD-' . strtoupper(Str::random(10)),
                'jumlah_total' => $totalHarga,
                'status'       => $statusAwal,
            ]);

            // B. BUAT DATA PEMBAYARAN
            // Relasi pembayaran() di Model Pesanan sudah kita set ke 'pesanan_id'
            if (method_exists($pesanan, 'pembayaran')) {
                $pesanan->pembayaran()->create([
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'status_pembayaran' => ($statusAwal == 'Lunas') ? 'success' : 'pending',
                    'jumlah_bayar'      => $totalHarga,
                    'tgl_bayar'         => ($statusAwal == 'Lunas') ? now() : null,
                ]);
            }

            // C. BUAT ITEM PESANAN
            foreach ($itemsData as $item) {
                for ($i = 0; $i < $item['jumlah_tiket']; $i++) {
                    ItemPesanan::create([
                        'order_id'       => $pesanan->id_pesanan, // PENTING: Pakai order_id sesuai DB
                        'ticket_type_id' => $item['ticket_type_id'],
                        'kode_tiket'     => 'TIX-' . strtoupper(Str::random(12)),
                        'status'         => 'Aktif',
                    ]);
                }
            }

            // Kurangi Stok
            $acara->decrement('stok', $totalTiket);

            DB::commit();

            return redirect()
                ->route('pesanan.index')
                ->with('success', "Pesanan berhasil! Status: {$statusAwal}");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateStatus($id)
    {
        DB::beginTransaction();
        try {
            $pesanan = Pesanan::findOrFail($id);
            $pesanan->update(['status' => 'Lunas']);

            // Update status pembayaran jika ada
            if ($pesanan->pembayaran) {
                $pesanan->pembayaran()->update([
                    'status_pembayaran' => 'success',
                    'tgl_bayar' => now()
                ]);
            }

            DB::commit();
            return redirect()->route('pesanan.index')->with('success', 'Pesanan Lunas!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    // ==========================================================
    // BAGIAN CETAK NOTA (SUDAH DIPISAH)
    // ==========================================================

    /**
     * 1. Cetak Nota ADMIN (Desain Baru/Bagus)
     * Digunakan di dashboard Admin
     */
    public function cetakNotaAdmin($id)
    {
        // PERBAIKAN:
        // Ganti 'itemPesanan.tiket' menjadi 'tipeTiket' dan 'acara'
        // Karena data tersimpan langsung di tabel pesanan
        $pesanan = Pesanan::with(['user', 'tipeTiket', 'acara'])->findOrFail($id);

        return view('admin.pesanan.nota', compact('pesanan'));
    }
    public function cetakNotaUser($id)
    {
        // PERBAIKAN:
        // Jangan pakai 'items.tiket', tapi pakai 'tipeTiket' dan 'acara'
        // Ini menyesuaikan dengan perubahan struktur database Anda tadi.
        $pesanan = \App\Models\Pesanan::with(['user', 'tipeTiket', 'acara'])->findOrFail($id);

        return view('user.dashboard.nota', compact('pesanan'));
    }

    // Fungsi PDF Laporan
    public function pdf(Request $request)
    {
        $query = Pesanan::with('user');
        $title = 'Laporan Riwayat Pesanan';

        if ($request->has('tanggal') && $request->tanggal != null) {
            $query->whereDate('created_at', $request->tanggal);
            $tanggalFormat = \Carbon\Carbon::parse($request->tanggal)->translatedFormat('d F Y');
            $title = 'Laporan Pesanan Tanggal ' . $tanggalFormat;
        }

        $data_pesanan = $query->orderBy('created_at', 'desc')->get();
        $pdf = PDF::loadView('admin.pesanan.pdf_view', compact('data_pesanan', 'title'));
        return $pdf->stream('Laporan_Pesanan.pdf');
    }
}
