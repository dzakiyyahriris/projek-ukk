@extends('user.layouts.app')

@section('css')
    <style>
        .caption-box {
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        #tombol-lihat-semua-wisata {
            z-index: 10;
        }

        /* 1. Container Utama Section */
        .section-wisata-bg {
            position: relative;
            width: 100%;
            background-image: url('https://monolooghotels.com/images/blog/juli/SURABAYA.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 80px 0;
            overflow: hidden;
        }

        /* 2. Overlay untuk Transisi Halus */
        .section-wisata-bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom,
                    #ffffff 0%,
                    rgba(0, 0, 0, 0.4) 45%,
                    rgba(0, 0, 0, 0.4) 80%,
                    #ffffff 100%);
            backdrop-filter: blur(1px);
            -webkit-backdrop-filter: blur(1px);
        }

        /* 3. Menempatkan Konten di Atas Blur */
        .section-wisata-bg .container {
            position: relative;
            z-index: 2;
        }

        .text-destinasi {
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .link-lihat-semua {
            color: #63b3ed;
        }

        .link-lihat-semua:hover {
            color: #ffffff;
        }
    </style>
@endsection

@section('content')
    @if (!Auth::check())
        <div class="container mb-5">
            <div class="col-md-12">
                <h2 class="fw-bold">Halo, Selamat Datang! 👋</h2>
                <p class="text-muted">"Siap mengeksplorasi keindahan Surabaya dengan cara yang jauh lebih modern? Nikmati
                    akses cepat ke berbagai tempat wisata pilihan tanpa perlu antre panjang. Wujudkan liburan impian bersama
                    keluarga dengan layanan tiket yang aman dan terpercaya. Mulai langkahmu sekarang dan rasakan keramahan
                    autentik dari jantung Jawa Timur!".</p>
            </div>
        </div>
    @endif

    <div>
        {{-- 1. CAROUSEL --}}
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div id="carouselWisata" class="carousel slide shadow-sm" data-bs-ride="carousel"
                        style="border-radius: 15px; overflow: hidden;">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselWisata" data-bs-slide-to="0" class="active"
                                aria-current="true"></button>
                            <button type="button" data-bs-target="#carouselWisata" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#carouselWisata" data-bs-slide-to="2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="3000">
                                <img src="{{ asset('images/sby.png') }}" class="d-block w-100"
                                    style="object-fit: cover; height: 400px;">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="caption-box"
                                        style="background: rgba(0,0,0,0.5); border-radius: 10px; padding: 10px;">
                                        <h1>WISATA PERAHU KALIMAS</h1>
                                        <p>Destinasi populer saat ini di Surabaya</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('images/sby2.jpg') }}" class="d-block w-100"
                                    style="object-fit: cover; height: 400px;">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="caption-box"
                                        style="background: rgba(0,0,0,0.5); border-radius: 10px; padding: 10px;">
                                        <h1>PATUNG SURA DAN BAYA</h1>
                                        <p>Ikon legendaris Kota Surabaya</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('images/alunalun.jpg') }}" class="d-block w-100"
                                    style="object-fit: cover; height: 400px;">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="caption-box"
                                        style="background: rgba(0,0,0,0.5); border-radius: 10px; padding: 10px;">
                                        <h1>ALUN ALUN KOTA SURABAYA</h1>
                                        <p>Pusat keramaian dan tugu unik Surabaya</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselWisata"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselWisata"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. DESTINASI POPULER --}}
        <div class="section-wisata-bg">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 d-flex justify-content-between align-items-center mb-4"
                        id="tombol-lihat-semua-wisata">
                        <h4 class="fw-bold mb-0">Destinasi Populer</h4>
                        <a href="{{ route('user.destinasi') }}" class="text-decoration-none fw-semibold">
                            Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                    @foreach ($events as $event)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm h-100 border-0" style="border-radius: 15px;">
                                <div class="position-relative">
                                    <img src="{{ asset($event->image_path) }}" class="card-img-top"
                                        style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;"
                                        alt="Wisata">
                                    <span class="position-absolute top-0 end-0 m-3 badge bg-white text-dark shadow-sm">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $event->nama }}</h5>
                                    <p class="text-muted small text-truncate">Nikmati pengalaman tak terlupakan di
                                        Surabaya.</p>
                                    <div class="d-grid">
                                        @auth
                                            <a href="{{ route('user.booking', $event->id_event) }}"
                                                class="btn btn-primary rounded-pill">Pesan Tiket</a>
                                        @else
                                            <a href="{{ route('user.booking', $event->id_event) }}"
                                                class="btn btn-warning rounded-pill text-white">Login untuk Pesan</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- 4. PESANAN SAYA --}}
        @auth
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 mb-4 d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold mb-0">
                            <i class="ti ti-shopping-cart me-2 text-primary"></i>Pesanan Saya
                        </h4>
                    </div>
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4 py-3 border-0 text-uppercase small fw-bold text-muted">Kode
                                                    Pesanan</th>
                                                <th class="py-3 border-0 text-uppercase small fw-bold text-muted">Total Bayar
                                                </th>
                                                <th class="py-3 border-0 text-uppercase small fw-bold text-muted text-center">
                                                    Status</th>
                                                <th class="py-3 border-0 text-uppercase small fw-bold text-muted">Tanggal
                                                    Kunjungan</th>
                                                <th class="py-3 border-0 text-uppercase small fw-bold text-muted text-center">
                                                    Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($orders as $order)
                                                <tr>
                                                    <td class="ps-4">
                                                        <span
                                                            class="fw-bold text-dark d-block">{{ $order->kode_pesanan }}</span>
                                                        <small class="text-muted">ID: #{{ $order->id_pesanan }}</small>
                                                    </td>
                                                    <td>
                                                        <span class="fw-semibold">Rp
                                                            {{ number_format($order->jumlah_total, 0, ',', '.') }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($order->status == 'Lunas')
                                                            <span
                                                                class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                                                <i class="ti ti-check me-1"></i>LUNAS
                                                            </span>
                                                        @elseif($order->status == 'bayar di loket')
                                                            <span
                                                                class="badge rounded-pill bg-info-subtle text-info border border-info-subtle px-3 py-2">
                                                                <i class="ti ti-map-pin me-1"></i>DI LOKET
                                                            </span>
                                                        @else
                                                            <span
                                                                class="badge rounded-pill bg-warning-subtle text-warning border border-warning-subtle px-3 py-2">
                                                                <i class="ti ti-clock me-1"></i>PENDING
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="ti ti-calendar me-2 text-muted"></i>
                                                            {{ $order->tanggal_kunjungan ? \Carbon\Carbon::parse($order->tanggal_kunjungan)->translatedFormat('d M Y') : '-' }}
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        @if (in_array($order->status, ['Lunas', 'bayar di loket', 'Verifikasi']))
                                                            <a href="{{ route('pesanan.nota', $order->id_pesanan) }}"
                                                                class="btn btn-sm btn-outline-primary rounded-pill px-4 transition-all">
                                                                <i class="ti ti-file-text me-1"></i>Lihat Nota
                                                            </a>
                                                        @else
                                                            <div class="btn-group shadow-sm rounded-pill overflow-hidden"
                                                                role="group">
                                                                <form
                                                                    action="{{ route('pembayaran.simpan', $order->id_pesanan) }}"
                                                                    method="POST" class="m-0">
                                                                    @csrf
                                                                    <input type="hidden" name="metode_pembayaran"
                                                                        value="cash">
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-success border-0 px-3 py-2"
                                                                        onclick="return confirm('Pilih metode bayar di loket?')">
                                                                        💵 Cash
                                                                    </button>
                                                                </form>
                                                                <a href="{{ route('pesanan.nota', $order->id_pesanan) }}"
                                                                    class="btn btn-sm btn-primary border-0 px-3 py-2">
                                                                    🏦 Transfer
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-5">
                                                        <div class="py-4">
                                                            <i class="ti ti-clipboard-off fs-1 text-muted mb-3 d-block"></i>
                                                            <p class="text-muted mb-0">Belum ada riwayat transaksi dilakukan.
                                                            </p>
                                                            <a href="{{ url('/') }}"
                                                                class="btn btn-primary mt-3 rounded-pill px-4">Pesan
                                                                Sekarang</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                /* Tambahan agar UI lebih halus */
                .transition-all {
                    transition: all 0.3s ease;
                }

                .transition-all:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }

                .bg-success-subtle {
                    background-color: #e8fadf !important;
                }

                .bg-info-subtle {
                    background-color: #e0f4ff !important;
                }

                .bg-warning-subtle {
                    background-color: #fff5e0 !important;
                }

                .badge {
                    letter-spacing: 0.5px;
                    font-weight: 600;
                }

                .btn-group .btn {
                    font-size: 0.75rem;
                    font-weight: 600;
                }
            </style>
        @endauth
    </div>
@endsection
