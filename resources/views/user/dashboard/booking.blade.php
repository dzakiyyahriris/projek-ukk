@extends('user.layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0" style="border-radius: 20px;">
                <div class="card-header bg-primary text-white p-4" style="border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-ticket-perforated-fill fs-2 me-3"></i>
                        <div>
                            <h4 class="mb-0 fw-bold">Konfirmasi Pemesanan</h4>
                            <p class="mb-0 opacity-75">{{ $event->nama }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- Alert Error Validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user.booking.store') }}" method="POST" id="bookingForm">
                        @csrf

                        {{-- Input Hidden --}}
                        <input type="hidden" name="wisata_id" value="{{ $event->id_event ?? $event->id }}">

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">
                                <i class="bi bi-calendar3 me-2"></i>Tanggal Kunjungan
                            </label>
                            <input type="date" name="tanggal_kunjungan" class="form-control form-control-lg border-2" 
                                   min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
                            <small class="text-muted">Pilih tanggal rencana kedatangan Anda.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark mb-3">
                                <i class="bi bi-tags-fill me-2"></i>Pilih Jenis Tiket
                            </label>
                            
                            @foreach ($event->tipeTiket as $tipe)
                                @php
                                    // Deteksi kolom stok (stok atau quota atau jumlah)
                                    $stokTersedia = $tipe->stok ?? $tipe->quota ?? $tipe->jumlah ?? 0;
                                    $isHabis = $stokTersedia <= 0;
                                @endphp
                                
                                <div class="ticket-option mb-3">
                                    <input type="radio" class="btn-check" name="ticket_type_id" 
                                           id="tiket_{{ $tipe->id_ticket_type }}" 
                                           value="{{ $tipe->id_ticket_type }}" 
                                           data-harga="{{ $tipe->harga }}"
                                           {{ $isHabis ? 'disabled' : '' }} required>
                                    
                                    <label class="btn btn-outline-primary w-100 text-start p-3 shadow-sm border-2 {{ $isHabis ? 'opacity-50' : '' }}" 
                                           for="tiket_{{ $tipe->id_ticket_type }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="h6 fw-bold mb-1 d-block">{{ $tipe->nama }}</span>
                                                @if($isHabis)
                                                    <span class="badge bg-danger">Habis Terjual</span>
                                                @elseif($stokTersedia < 10)
                                                    <span class="badge bg-warning text-dark">Sisa {{ $stokTersedia }} tiket!</span>
                                                @else
                                                    <span class="badge bg-success-subtle text-success border border-success">Tersedia</span>
                                                @endif
                                            </div>
                                            <div class="text-end">
                                                <span class="fs-5 fw-bold text-primary">Rp {{ number_format($tipe->harga, 0, ',', '.') }}</span>
                                                <small class="d-block text-muted">/ orang</small>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">
                                <i class="bi bi-person-plus-fill me-2"></i>Jumlah Pengunjung
                            </label>
                            <div class="input-group input-group-lg border-2">
                                <button class="btn btn-outline-secondary" type="button" id="btn-minus"><i class="bi bi-dash-lg"></i></button>
                                <input type="number" name="jumlah" id="jumlah_tiket" class="form-control text-center fw-bold" 
                                       value="1" min="1" required readonly>
                                <button class="btn btn-outline-secondary" type="button" id="btn-plus"><i class="bi bi-plus-lg"></i></button>
                            </div>
                        </div>

                        <div class="card bg-light border-0 mb-4" style="border-radius: 15px;">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted fw-bold">Total Pembayaran:</span>
                                    <span class="h3 mb-0 fw-bold text-primary" id="total_bayar">Rp 0</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold shadow" style="border-radius: 12px;">
                            PESAN SEKARANG <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                        </button>
                        
                        <a href="{{ route('landing') }}" class="btn btn-link w-100 text-muted mt-2">Batal dan Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ticket-option .btn-check:checked + .btn-outline-primary {
        background-color: rgba(13, 110, 253, 0.08);
        border-color: #0d6efd;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioTiket = document.querySelectorAll('input[name="ticket_type_id"]');
        const inputJumlah = document.getElementById('jumlah_tiket');
        const displayTotal = document.getElementById('total_bayar');
        const btnPlus = document.getElementById('btn-plus');
        const btnMinus = document.getElementById('btn-minus');

        function hitungTotal() {
            let harga = 0;
            radioTiket.forEach(radio => {
                if (radio.checked) {
                    harga = radio.getAttribute('data-harga');
                }
            });
            const total = harga * inputJumlah.value;
            displayTotal.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        }

        // Event Listeners
        radioTiket.forEach(r => r.addEventListener('change', hitungTotal));

        btnPlus.addEventListener('click', () => {
            inputJumlah.value = parseInt(inputJumlah.value) + 1;
            hitungTotal();
        });

        btnMinus.addEventListener('click', () => {
            if (inputJumlah.value > 1) {
                inputJumlah.value = parseInt(inputJumlah.value) - 1;
                hitungTotal();
            }
        });

        // Inisialisasi awal
        hitungTotal();
    });
</script>
@endsection