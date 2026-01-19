@extends('user.layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-primary">Tiket Saya (Aktif)</h3>
                <p class="text-muted small">Daftar tiket yang sudah Anda pesan dan siap digunakan.</p>
            </div>
            <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                <i class="ti ti-plus"></i> Pesan Lagi
            </a>
        </div>

        {{-- Menggunakan variabel $orders sesuai dengan yang ada di dashboard Anda --}}
        @if (isset($orders) && $orders->count() > 0)
            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm"
                            style="border-radius: 15px; border-left: 5px solid #0d6efd !important;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="w-75">
                                        <small class="text-muted fw-bold">#{{ $order->kode_pesanan }}</small>

                                        {{-- PERBAIKAN UTAMA DI SINI: --}}
                                        {{-- Hapus 'items->first()', langsung panggil 'acara' --}}
                                        <h5 class="fw-bold mt-1 text-dark text-truncate">
                                            {{ $order->acara->nama ?? 'Destinasi Wisata' }}
                                        </h5>
                                        {{-- Opsional: Tampilkan Nama Tipe Tiket --}}
                                        <span class="badge bg-light text-dark border mb-2">
                                            {{ $order->tipeTiket->nama_tipe ?? 'Tiket' }}
                                        </span>

                                        <div class="mb-3">
                                            <p class="small text-muted mb-1">
                                                <i class="ti ti-calendar-event me-1"></i>
                                                Kunjungan:
                                                <strong>{{ $order->tanggal_kunjungan ? \Carbon\Carbon::parse($order->tanggal_kunjungan)->translatedFormat('d M Y') : '-' }}</strong>
                                            </p>
                                            <p class="small text-muted mb-0">
                                                <i class="ti ti-shopping-cart me-1"></i>
                                                Dipesan: {{ $order->created_at->translatedFormat('d M Y') }}
                                            </p>
                                        </div>

                                        {{-- LOGIKA STATUS --}}
                                        @if (strtolower($order->status) == 'lunas' || strtolower($order->status) == 'paid')
                                            <span class="badge bg-success px-3 py-2 rounded-pill">
                                                <i class="ti ti-check me-1"></i> LUNAS
                                            </span>
                                        @elseif (strtolower($order->metode_pembayaran) == 'cash' && strtolower($order->status) != 'lunas')
                                            <span class="badge bg-warning text-white px-3 py-2 rounded-pill">
                                                <i class="ti ti-wallet me-1"></i> BAYAR DI LOKET
                                            </span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                                {{ strtoupper($order->status) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="text-end">
                                        <h4 class="fw-bold text-primary mb-3">
                                            Rp {{ number_format($order->jumlah_total, 0, ',', '.') }}
                                        </h4>
                                        <a href="{{ route('pesanan.nota', $order->id_pesanan) }}"
                                            class="btn btn-primary rounded-pill px-4 shadow-sm" target="_blank">
                                            Nota <i class="ti ti-chevron-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Tampilan jika pesanan masih kosong --}}
            <div class="card border-0 shadow-sm py-5 mt-2" style="border-radius: 20px;">
                <div class="card-body text-center py-5">
                    <div class="mb-4 text-muted opacity-50">
                        <i class="ti ti-ticket-off" style="font-size: 100px;"></i>
                    </div>
                    <h4 class="fw-bold text-dark">Belum ada tiket yang aktif</h4>
                    <p class="text-muted mx-auto mb-4" style="max-width: 400px;">
                        Sepertinya Anda belum memiliki riwayat pemesanan. Yuk, cari destinasi seru di Surabaya sekarang!
                    </p>
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                        Cari Destinasi Sekarang
                    </a>
                </div>
            </div>
        @endif
    </div>

    <style>
        body {
            background-color: #f8faff;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
        }
    </style>
@endsection
