@extends('admin.layouts.app')

@section('css')
    {{-- CSS Tambahan --}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Ubah Data {{ $title }}</h5>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama Item --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Item</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Nama Item" value="{{ old('name', $item->name) }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                id="category_id" required>
                                <option value="" disabled>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Foto --}}
                        <div class="mb-3">
                            <label for="photo" class="form-label">Ganti Foto (Opsional)</label>

                            {{-- Tampilkan foto saat ini --}}
                            @if ($item->photo)
                                <div class="mb-2">
                                    <p class="mb-1 fw-semibold">Foto Saat Ini:</p>
                                    <img src="{{ asset('photos/' . $item->photo) }}" alt="Foto Item"
                                        class="img-fluid rounded" style="max-width: 150px;">
                                </div>
                            @else
                                <p class="text-muted">Item ini belum memiliki foto.</p>
                            @endif

                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                                id="photo" accept="image/*">
                            @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-text">Kosongkan jika tidak ingin mengganti foto. Maks: 2MB.</div>
                        </div>

                        {{-- Kode Unik --}}
                        <div class="mb-3">
                            <label for="unique_code" class="form-label">Kode Unik (Opsional)</label>
                            <input type="text" class="form-control @error('unique_code') is-invalid @enderror"
                                name="unique_code" id="unique_code" placeholder="Contoh: MM-001"
                                value="{{ old('unique_code', $item->unique_code) }}">
                            @error('unique_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Kondisi --}}
                        <div class="mb-3">
                            <label for="condition" class="form-label">Kondisi</label>
                            <select class="form-select @error('condition') is-invalid @enderror" name="condition"
                                id="condition" required>
                                <option value="Baik"
                                    {{ old('condition', $item->condition) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak"
                                    {{ old('condition', $item->condition) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                            @error('condition')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                        <a href="{{ route('item.index') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- JS Tambahan --}}
@endsection
