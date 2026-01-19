@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Data {{ $title }}</h5>
            
            {{-- Form untuk CREATE: mengarah ke acara.store --}}
            <form action="{{ route('acara.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Acara</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal dan Waktu Acara</label>
                    {{-- Pastikan format input sesuai dengan yang dibutuhkan oleh database (misalnya datetime-local) --}}
                    <input type="datetime-local" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Acara</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Simpan Data</button>
                <a href="{{ route('acara.index') }}" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>
@endsection