@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Manajemen Data Acara</h5>

                {{-- Baris Tombol & Filter --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex gap-2">
                        <a href="{{ route('acara.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i> Tambah
                        </a>
                        {{-- Tombol PDF Acara (Bukan User) --}}
                        <a href="{{ route('acara.pdf', request()->query()) }}" target="_blank" class="btn btn-danger">
                            <i class="ti ti-file-text"></i> PDF
                        </a>
                    </div>

                    {{-- Pencarian & Filter Tanggal (Sesuai Desain User Management) --}}
                    <form action="{{ route('acara.index') }}" method="GET" class="d-flex gap-2">
                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="50px">No</th>
                                <th>Nama Acara</th>
                                <th>Tanggal</th>
                                <th width="150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($acara as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $item->nama }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('acara.edit', $item->id_event) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('acara.destroy', $item->id_event) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Menampilkan Navigasi Halaman (Pagination) --}}
                    <div class="mt-3">
                        {{ $acara->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
