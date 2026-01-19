@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Ubah Data {{ $title }}</h5>
            
            <form action="{{ route('tipe_tiket.update', $tipeTiket->id_ticket_type) }}" method="POST">
                @csrf
                @method('PUT')
                
                {{-- 1. PILIH ACARA --}}
                <div class="mb-3">
                    <label for="event_id" class="form-label">Pilih Acara</label>
                    <select class="form-select @error('event_id') is-invalid @enderror" id="event_id" name="event_id" required>
                        <option value="">-- Pilih Acara --</option>
                        @foreach ($acara as $item)
                            <option value="{{ $item->id_event }}" 
                                {{ old('event_id', $tipeTiket->event_id) == $item->id_event ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- 2. NAMA TIKET --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Tipe Tiket</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" 
                           value="{{ old('nama', $tipeTiket->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- 3. HARGA --}}
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" step="0.01" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" 
                           value="{{ old('harga', $tipeTiket->harga) }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 4. STOK (UPDATE STOK) --}}
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok Tiket</label>
                    {{-- Perhatikan bagian value: old('stok', $tipeTiket->stok) --}}
                    <input type="number" min="0" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" 
                           value="{{ old('stok', $tipeTiket->stok) }}" required>
                    <small class="text-muted">Ubah angka ini untuk menambah atau mengurangi stok.</small>
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Update Data</button>
                <a href="{{ route('tipe_tiket.index') }}" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>
@endsection