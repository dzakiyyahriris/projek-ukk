@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- Alert Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Daftar {{ $title ?? 'Pesanan' }}</h5>

                {{-- BARIS TOMBOL & FILTER --}}
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

                    {{-- Bagian Kiri: Tombol Aksi --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('pesanan.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                            <i class="ti ti-plus"></i> Buat Pesanan
                        </a>

                        <a href="{{ route('pesanan.pdf', request()->query()) }}" target="_blank"
                            class="btn btn-danger d-flex align-items-center gap-2">
                            <i class="ti ti-file-text"></i> PDF
                        </a>
                    </div>

                    {{-- Bagian Kanan: Filter Tanggal --}}
                    <div class="d-flex gap-2 align-items-center">
                        <form action="{{ route('pesanan.index') }}" method="GET" class="d-flex gap-2">
                            <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                            <button type="submit" class="btn btn-info">Filter</button>
                        </form>

                        @if (request('tanggal'))
                            <a href="{{ route('pesanan.index') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </div>

                {{-- TABEL DATA --}}
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th width="200px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-light-info text-info fw-bold">{{ $item->kode_pesanan }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $item->user->name ?? 'Pengunjung Umum' }}</div>
                                        <small class="text-muted">{{ $item->user->email ?? '-' }}</small>
                                    </td>
                                    <td>{{ 'Rp ' . number_format($item->jumlah_total, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($item->status == 'Lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @elseif($item->status == 'Bayar di Tempat')
                                            <span class="badge bg-primary">Bayar di Loket</span>
                                        @else
                                            <span class="badge bg-warning text-dark">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-1">

                                            {{-- 2. TOMBOL CETAK NOTA (Gunakan route 'pesanan.nota') --}}
                                            {{-- Tombol Cetak Nota Admin --}}
                                            <a href="{{ route('admin.pesanan.nota', $item->id_pesanan) }}" target="_blank"
                                                class="btn btn-warning btn-sm" title="Cetak Nota">
                                                <i class="ti ti-printer"></i> Cetak
                                            </a>

                                            {{-- 3. TOMBOL KONFIRMASI LUNAS (Gunakan route 'admin.pesanan.updateStatus') --}}
                                            @if ($item->status !== 'Lunas')
                                                {{-- PERHATIKAN BARIS DI BAWAH INI YANG SEBELUMNYA ERROR --}}
                                                <form action="{{ route('admin.pesanan.updateStatus', $item->id_pesanan) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm"
                                                        onclick="return confirm('Konfirmasi pelunasan untuk pesanan {{ $item->kode_pesanan }}?')"
                                                        title="Konfirmasi Lunas">
                                                        <i class="ti ti-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> {{-- Tutup Card Body --}}
        </div> {{-- Tutup Card --}}
    </div> {{-- Tutup Container Fluid --}}
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    {{-- Pastikan script DataTables sudah di-load di layout utama --}}
    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#datatable')) {
                $('#datatable').DataTable().destroy();
            }

            $('#datatable').DataTable({
                "searching": true,
                {{-- Saya aktifkan lagi pencariannya agar lebih memudahkan Admin --}} "lengthChange": true,
                "ordering": true,
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Hal _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(difilter dari _MAX_ total data)"
                }
            });
        });
    </script>
@endsection
