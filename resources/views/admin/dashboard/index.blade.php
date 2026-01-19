@extends('admin.layouts.app')

@section('css')
<style>
    .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .icon-shape {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }
    /* Warna Custom Tambahan */
    .bg-light-primary { background-color: #ecf2ff !important; color: #5d87ff !important; }
    .bg-light-success { background-color: #e6fffa !important; color: #13deb9 !important; }
    .bg-light-warning { background-color: #fef5e5 !important; color: #ffae1f !important; }
    .bg-light-danger { background-color: #fdede8 !important; color: #fa896b !important; }
    
    .text-primary-dark { color: #4570ea !important; }
    .text-success-dark { color: #02b3a9 !important; }
    .text-warning-dark { color: #e89500 !important; }
</style>
@endsection

@section('content')
<div class="container-fluid">

    {{-- ========================================== --}}
    {{-- PERINGATAN STOK MENIPIS (FITUR BARU) --}}
    {{-- ========================================== --}}
    <div class="row">
        @php
            // Ambil acara yang stoknya kurang dari 10 (Stok Kritis)
            // Pastikan model Acara sudah diimport atau gunakan full namespace
            $stok_menipis = \App\Models\Acara::where('stok', '<', 10)->get();
        @endphp

        @if($stok_menipis->count() > 0)
        <div class="col-12 mb-4">
            <div class="alert alert-danger d-flex align-items-center shadow-sm border-0" role="alert" style="background-color: #fdede8; color: #5f2120;">
                <div class="icon-shape bg-danger text-white me-3 rounded-circle" style="width: 40px; height: 40px; min-width: 40px;">
                    <i class="ti ti-alert-triangle fs-5"></i>
                </div>
                <div>
                    <h5 class="alert-heading fw-bold mb-1 text-danger">Peringatan Stok Menipis!</h5>
                    <p class="mb-0 fs-3">Segera perbarui stok untuk acara berikut:</p>
                    <ul class="mb-0 ps-3 mt-1">
                        @foreach($stok_menipis as $item)
                            <li>
                                Acara <strong>{{ $item->nama }}</strong> 
                                (Sisa: <span class="badge bg-danger rounded-pill">{{ $item->stok }}</span>)
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
    {{-- ========================================== --}}

    {{-- Row 1: Welcome Message --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light-primary border-0 overflow-hidden shadow-none">
                <div class="card-body py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-6">
                            <h3 class="fw-semibold mb-2">Selamat Datang, {{ Auth::user()->name }}! 🚀</h3>
                            <p class="mb-0">Pantau performa sistem Anda melalui ringkasan di bawah ini.</p>
                        </div>
                        <div class="col-sm-6 d-none d-sm-block text-end">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/welcome-bg.svg" alt="welcome" class="img-fluid" width="180">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 2: Statistics Cards --}}
    <div class="row">
        {{-- Total Admin - BLUE --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-start border-primary border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-shape bg-light-primary me-3 shadow-sm">
                            <i class="ti ti-users fs-7"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 fw-medium">Total Admin</p>
                            <h2 class="fw-bold mb-0 text-primary-dark">{{ $total_admin }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                        <small class="text-muted mt-2 d-block">Admin Aktif di Sistem</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Acara - GREEN --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-shape bg-light-success me-3 shadow-sm">
                            <i class="ti ti-calendar-event fs-7"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 fw-medium">Total Acara</p>
                            <h2 class="fw-bold mb-0 text-success-dark">{{ $total_acara }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                        <small class="text-muted mt-2 d-block">Jumlah Event Terdaftar</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Pesanan - WARNING/ORANGE --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-shape bg-light-warning me-3 shadow-sm">
                            <i class="ti ti-shopping-cart fs-7"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 fw-medium">Total Pesanan</p>
                            <h2 class="fw-bold mb-0 text-warning-dark">{{ $total_pesanan }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 100%"></div>
                        </div>
                        <small class="text-muted mt-2 d-block">Transaksi Berjalan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- (Opsional) Tempat Grafik jika ingin dimunculkan --}}
    {{-- <div id="chart-pesanan"></div> --}}

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        series: [{
            name: 'Pesanan',
            data: [15, 25, 18, 40, 32, 75, 60] // Data dummy
        }],
        chart: {
            height: 320,
            type: 'area',
            fontFamily: 'Plus Jakarta Sans, sans-serif',
            toolbar: { show: false },
            zoom: { enabled: false }
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.1,
                stops: [0, 90, 100]
            }
        },
        colors: ['#5d87ff'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 3 },
        xaxis: {
            categories: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"],
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        grid: {
            borderColor: 'rgba(0,0,0,0.05)',
            strokeDashArray: 4,
        },
        tooltip: { theme: 'light' },
    };

    // Pastikan elemen ID chart-pesanan ada di HTML jika ingin grafik muncul
    var chartElement = document.querySelector("#chart-pesanan");
    if(chartElement){
        var chart = new ApexCharts(chartElement, options);
        chart.render();
    }
</script>
@endsection