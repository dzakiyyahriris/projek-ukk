<?php

namespace App\Http\Controllers\User; // Tambahkan \User di sini

use App\Http\Controllers\Controller; // Tambahkan baris ini karena folder berubah
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Memproses data pembayaran dari user
     */
    public function prosesPembayaran(Request $request, $id_pesanan)
    {
        $pesanan = Pesanan::findOrFail($id_pesanan);

        if ($request->metode_pembayaran == 'cash') {
            // Update status ke 'bayar di loket' (Bukan Lunas)
            $pesanan->update([
                'metode_pembayaran' => 'cash',
                'status' => 'bayar di loket'
            ]);

            return redirect()->route('pembayaran.instruksi', $pesanan->id_pesanan)
                ->with('success', 'Metode pembayaran Cash dipilih. Silakan tunjukkan nota ini ke loket.');
        }

        // Jika Transfer (Logika lama Anda)
        if ($request->hasFile('bukti_pembayaran')) {
            // simpan file...
            $pesanan->update([
                'metode_pembayaran' => 'transfer',
                'status' => 'waiting_verification' // atau 'Verifikasi'
            ]);
        }

        return back()->with('success', 'Bukti transfer berhasil diunggah.');
    }
    public function konfirmasiAdmin($id_pembayaran)
    {
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);

        // Update status pembayaran menjadi sukses
        $pembayaran->update([
            'status_pembayaran' => 'success',
            'tanggal_bayar'     => now() // Isi tanggal bayar saat dikonfirmasi admin
        ]);

        // Update status pesanan induk menjadi sukses/lunas
        $pembayaran->pesanan->update([
            'status' => 'paid'
        ]);

        return redirect()->back()->with('success', 'Pembayaran telah dikonfirmasi dan pesanan lunas.');
    }
    public function instruksi($id_pesanan)
    {
        $pesanan = Pesanan::with('pembayaran')->findOrFail($id_pesanan);

        // Jika pesanan sudah lunas, langsung arahkan ke nota
        if ($pesanan->status == 'paid' || $pesanan->status == 'Lunas') {
            return redirect()->route('pesanan.nota', $id_pesanan);
        }

        return view('user.pembayaran_instruksi', compact('pesanan'));
    }
    /**
     * Memproses pembayaran cash di tempat (oleh petugas/kasir)
     */
    public function bayarCash(Request $request, $id_pesanan)
    {
        // 1. Validasi nominal uang yang dimasukkan
        $request->validate([
            'uang_bayar' => 'required|numeric|min:0',
        ]);

        $pesanan = Pesanan::findOrFail($id_pesanan);

        // Cek apakah uang cukup (keamanan sisi server)
        if ($request->uang_bayar < $pesanan->jumlah_total) {
            return redirect()->back()->with('error', 'Jumlah uang yang dimasukkan tidak mencukupi.');
        }

        // 2. Update atau Create data di tabel Pembayaran
        Pembayaran::updateOrCreate(
            ['pesanan_id' => $pesanan->id_pesanan],
            [
                'jumlah_bayar'      => $request->uang_bayar,
                'metode_pembayaran' => 'cash',
                'status_pembayaran' => 'success', // Langsung success karena cash diterima
                'tanggal_bayar'     => now(),
            ]
        );

        // 3. Update status Pesanan menjadi Lunas (paid)
        $pesanan->update([
            'status' => 'lunas'
        ]);

        // 4. Alihkan ke halaman nota/invoice
        return redirect()->route('pesanan.nota', $id_pesanan)
            ->with('success', 'Pembayaran cash berhasil diproses. Pesanan lunas!');
    }
}
