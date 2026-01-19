@extends('user.layouts.app')

@section('content')
<div class="container py-5" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <div class="card-body">
                    {{-- Ikon Status (Jam/Pending) --}}
                    <div class="mb-4 text-warning">
                        <i class="ti ti-clock" style="font-size: 4rem;"></i>
                    </div>

                    <h3 class="fw-bold text-dark mb-2">Menunggu Persetujuan</h3>
                    <p class="text-muted mb-4">
                        Pesanan <strong>{{ $pesanan->kode_pesanan }}</strong> telah kami terima. 
                        Admin akan segera memverifikasi pembayaran Anda.
                    </p>

                    {{-- Ringkasan Kecil --}}
                    <div class="bg-light rounded-3 p-3 mb-4 text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Metode Pembayaran</span>
                            <span class="fw-bold text-dark small">
                                {{ $pesanan->pembayaran->metode_pembayaran == 'cash' ? 'Bayar di Tempat' : 'Transfer Bank' }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Total Tagihan</span>
                            <span class="fw-bold text-primary small">Rp {{ number_format($pesanan->jumlah_total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-grid gap-2">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary rounded-pill">
                            Kembali ke Beranda
                        </a>
                        <a href="{{ route('pesanan.index') }}" class="btn btn-light text-muted rounded-pill">
                            Cek Daftar Pesanan Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection