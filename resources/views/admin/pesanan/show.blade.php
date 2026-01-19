@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Detail {{ $title }} #{{ $pesanan->kode_pesanan }}</h5>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-light p-3 mb-4">
                        <h6><i class="fas fa-info-circle"></i> Informasi Pesanan</h6>
                        <table class="table table-borderless table-sm">
                            <tr><th>Kode Pesanan</th><td>: <span class="badge bg-primary">{{ $pesanan->kode_pesanan }}</span></td></tr>
                            <tr><th>Pelanggan</th><td>: {{ $pesanan->user->name ?? 'N/A' }} ({{ $pesanan->user->email ?? 'N/A' }})</td></tr>
                            <tr><th>Total Bayar</th><td>: <strong>{{ 'Rp ' . number_format($pesanan->jumlah_total, 0, ',', '.') }}</strong></td></tr>
                            <tr><th>Status</th><td>: <span class="badge bg-success">{{ $pesanan->status }}</span></td></tr>
                            <tr><th>Tanggal Pesan</th><td>: {{ $pesanan->created_at->format('d M Y H:i') }}</td></tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light p-3 mb-4">
                        <h6><i class="fas fa-calendar-alt"></i> Informasi Acara</h6>
                         {{-- Ambil informasi acara dari item pertama --}}
                        @if($pesanan->items->first())
                            @php
                                $acara = $pesanan->items->first()->tipeTiket->acara ?? null;
                            @endphp
                            <table class="table table-borderless table-sm">
                                <tr><th>Nama Acara</th><td>: {{ $acara->nama ?? 'N/A' }}</td></tr>
                                <tr><th>Tanggal Acara</th><td>: {{ $acara ? $acara->tanggal->format('d M Y H:i') : 'N/A' }}</td></tr>
                                <tr><th>Tipe Tiket</th><td>: {{ $pesanan->items->first()->tipeTiket->nama ?? 'N/A' }}</td></tr>
                            </table>
                        @else
                            <p>Tidak ada item tiket dalam pesanan ini.</p>
                        @endif
                    </div>
                </div>
            </div>

            <hr>

            {{-- Detail Item Tiket --}}
            <h6 class="mt-4 mb-3">🎫 Daftar Tiket (Item Pesanan)</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Tiket</th>
                            <th>Tipe Tiket</th>
                            <th>Harga Satuan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan->items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge bg-secondary">{{ $item->kode_tiket }}</span></td>
                                <td>{{ $item->tipeTiket->nama ?? 'N/A' }}</td>
                                <td>{{ 'Rp ' . number_format($item->tipeTiket->harga ?? 0, 0, ',', '.') }}</td>
                                <td><span class="badge bg-success">{{ $item->status }}</span></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-end fw-bold">TOTAL TIKET</td>
                            <td class="fw-bold">{{ $pesanan->items->count() }} Buah</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>

                @if($pesanan->status == 'Pending')
                    <form action="{{ route('pesanan.updateStatus', $pesanan->id_pesanan) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success float-end">
                            <i class="fas fa-money-bill-wave"></i> Konfirmasi Pembayaran (Set Lunas)
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection