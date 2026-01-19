@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Validasi & Pembayaran Loket</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Check-in</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3 text-center">
                    <i class="ti ti-scan fs-8 text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            {{-- Bagian 1: Form Pencarian Tiket --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body p-4 text-center">
                    <div class="bg-light-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="ti ti-qrcode fs-6 text-primary"></i>
                    </div>
                    <h3 class="fw-bold">Input Kode Tiket</h3>
                    <p class="text-muted">Masukkan kode untuk memproses pembayaran/check-in</p>

                    <form action="{{ route('admin.checkin.check') }}" method="POST" id="formCekTiket">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="kode_tiket" id="kode_tiket"
                                class="form-control form-control-lg text-center fw-bold text-uppercase"
                                placeholder="ORD-XXXXXX" required value="{{ old('kode_tiket', $pesanan->kode_tiket ?? '') }}"
                                style="letter-spacing: 2px; font-size: 1.5rem;">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fs-4">
                            <i class="ti ti-search me-2"></i> Cari Tiket
                        </button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Bagian 2: Tampilan Simulasi Kasir (Hanya muncul jika tiket ditemukan & status bayar di loket) --}}
            @if(isset($pesanan) && $pesanan->status == 'bayar di loket')
            <div class="card shadow-lg border-primary">
                <div class="card-header bg-primary p-3">
                    <h5 class="text-white mb-0 fw-bold"><i class="ti ti-calculator me-2"></i>Simulasi Kasir Loket</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="p-2 rounded-3 bg-light text-center border">
                                <small class="text-muted d-block small">Nama Pemesan</small>
                                <h6 class="fw-bold mb-0">{{ $pesanan->user->name ?? 'Guest' }}</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 rounded-3 bg-primary text-white text-center">
                                <small class="opacity-75 d-block small">Total Tagihan</small>
                                <h5 class="fw-bold mb-0">Rp {{ number_format($pesanan->jumlah_total, 0, ',', '.') }}</h5>
                                <input type="hidden" id="total_tagihan" value="{{ $pesanan->jumlah_total }}">
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.checkin.process_payment', $pesanan->id_pesanan) }}" method="POST">
                        @csrf
                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-sm-6">
                                <label class="small fw-bold text-muted mb-1">Uang Diterima (Rp):</label>
                                <input type="number" id="uang_bayar" name="uang_bayar"
                                    class="form-control form-control-lg border-primary border-2"
                                    placeholder="0" oninput="hitungKembalian()" required autofocus>
                            </div>
                            <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
                                <label class="small fw-bold text-muted mb-1">Kembalian:</label>
                                <h2 class="fw-black text-dark mb-0" id="tampilan_kembalian">Rp 0</h2>
                            </div>
                        </div>

                        <div id="pesan_kurang" class="alert alert-soft-danger small mb-3" style="display:none;">
                            <i class="ti ti-alert-circle"></i> Nominal uang tidak mencukupi
                        </div>

                        <div class="d-grid">
                            <button type="submit" id="btn-bayar" class="btn btn-success btn-lg fw-bold py-3 disabled">
                                <i class="ti ti-check me-1"></i> Konfirmasi Bayar & Check-in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .bg-light-info { background-color: #e1f5fe; }
    .bg-light-primary { background-color: #e3f2fd; }
    .alert-soft-danger { background-color: #ffeef3; color: #d63384; border: 1px solid #ffcadb; }
    .fw-black { font-weight: 900; }
</style>

<script>
    function hitungKembalian() {
        const total = parseInt(document.getElementById('total_tagihan').value) || 0;
        const bayarInput = document.getElementById('uang_bayar');
        const bayar = parseInt(bayarInput.value) || 0;
        const tampilan = document.getElementById('tampilan_kembalian');
        const pesanKurang = document.getElementById('pesan_kurang');
        const btnBayar = document.getElementById('btn-bayar');

        if (bayar === 0) {
            tampilan.innerText = "Rp 0";
            tampilan.className = "fw-black text-dark mb-0";
            pesanKurang.style.display = 'none';
            btnBayar.classList.add('disabled');
            return;
        }

        const kembalian = bayar - total;

        if (kembalian < 0) {
            tampilan.innerText = "Rp 0";
            tampilan.className = "fw-black text-danger mb-0";
            pesanKurang.style.display = 'block';
            btnBayar.classList.add('disabled');
        } else {
            tampilan.innerText = "Rp " + kembalian.toLocaleString('id-ID');
            tampilan.className = "fw-black text-success mb-0";
            pesanKurang.style.display = 'none';
            btnBayar.classList.remove('disabled');
        }
    }
</script>
@endsection