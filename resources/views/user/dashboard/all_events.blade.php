@extends('user.layouts.app')

@section('content')
<div class="container py-5">
    {{-- Header Judul --}}
    <div class="row mb-5 text-center">
        <div class="col-lg-8 mx-auto">
            <h2 class="fw-bold display-5">Semua Destinasi & Acara</h2>
            <p class="text-muted lead">Jelajahi berbagai pengalaman menarik yang tersedia untuk Anda.</p>
        </div>
    </div>

    {{-- Daftar Card --}}
    <div class="row g-4">
        @forelse($events as $event)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden hover-card">
                {{-- Gambar --}}
                <div class="position-relative">
                    <img src="{{ asset($event->image_path) }}" 
                         class="card-img-top" 
                         style="height: 220px; object-fit: cover;" 
                         alt="{{ $event->nama }}"
                         onerror="this.src='https://via.placeholder.com/400x250?text=Gambar+Tidak+Ada'">
                    
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-white text-primary shadow-sm px-3 py-2 rounded-pill">
                            <i class="bi bi-calendar-event me-1"></i> 
                            {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}
                        </span>
                    </div>
                </div>

                {{-- Konten Body --}}
                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="card-title fw-bold text-dark mb-2">{{ $event->nama }}</h5>
                    
                    <p class="card-text text-muted mb-4 small">
                        {{ Str::limit($event->deskripsi ?? 'Tidak ada deskripsi tambahan.', 100) }}
                    </p>

                    <div class="mt-auto d-grid">
                        @auth
                            {{-- Tombol Pesan (Jika User Login) --}}
                            <a href="{{ route('user.booking', $event->id_event ?? $event->id) }}" 
                               class="btn btn-primary rounded-pill fw-bold py-2">
                               Pesan Tiket Sekarang
                            </a>
                        @else
                            {{-- Tombol Login (Jika Belum Login) --}}
                            <a href="{{ route('login') }}" 
                               class="btn btn-outline-primary rounded-pill fw-bold py-2">
                               Login untuk Pesan
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @empty
        {{-- Jika Data Kosong --}}
        <div class="col-12 text-center py-5">
            <div class="mb-3">
                <i class="bi bi-inbox text-muted opacity-25" style="font-size: 4rem;"></i>
            </div>
            <h4 class="text-muted">Belum ada acara tersedia saat ini.</h4>
        </div>
        @endforelse
    </div>

    {{-- Pagination (Navigasi Halaman) --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $events->links() }}
    </div>
</div>

<style>
    /* Efek Hover Halus */
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection