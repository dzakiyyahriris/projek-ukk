@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Ubah Data {{ $title }}</h5>
            
            {{-- Form untuk UPDATE: mengarah ke acara.update dan menggunakan method PUT/PATCH --}}
            <form action="{{ route('acara.update', $acara->id_event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Penting untuk Resource Controller Update --}}
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Acara</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $acara->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal dan Waktu Acara</label>
                    {{-- Menggunakan format YYYY-MM-DDTHH:MM untuk input datetime-local --}}
                    <input type="datetime-local" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" 
                           value="{{ old('tanggal', $acara->tanggal->format('Y-m-d\TH:i')) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Ganti Gambar (Kosongkan jika tidak ingin mengubah)</label>
                    @if($acara->image_path)
                        <div class="mb-2">
                            <img src="{{ asset($acara->image_path) }}" width="150" class="img-thumbnail" alt="Current Image">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Update Data</button>
                <a href="{{ route('acara.index') }}" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>
@endsection