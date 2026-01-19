@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Manajemen Data Pengguna</h5>

                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah</a>

                        {{-- TOMBOL PDF: Perhatikan bagian route() --}}
                        {{-- Kita kirim parameter 'tanggal' yang diambil dari URL saat ini --}}
                        <a href="{{ route('users.pdf', ['tanggal' => request('tanggal')]) }}" target="_blank"
                            class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </div>

                    {{-- FORM PENCARIAN TANGGAL --}}
                    <form action="{{ route('users.index') }}" method="GET" class="d-flex">
                        <input type="date" name="tanggal" class="form-control me-2" value="{{ request('tanggal') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Cari
                        </button>

                        {{-- Tombol Reset (Opsional: untuk hapus filter) --}}
                        @if (request('tanggal'))
                            <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">Reset</a>
                        @endif
                    </form>
                </div>

                {{-- Tabel Daftar User --}}
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nama Pengguna</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Email</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Role</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tanggal Bergabung</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $user->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $user->email }}</p>
                                    </td>

                                    {{-- PERBAIKAN KOLOM ROLE --}}
                                    <td class="border-bottom-0">
                                        @php
                                            // Cek usertype, jika kosong cek role, jika kosong set 'user'
                                            $roleName = $user->usertype ?? ($user->role ?? 'user');

                                            // Tentukan warna badge (Admin = Biru, Lainnya = Hijau)
                                            // strtolower agar tidak sensitif huruf besar/kecil
                                            $badgeColor =
                                                strtolower($roleName) === 'admin' ? 'bg-primary' : 'bg-success';
                                        @endphp

                                        <span class="badge {{ $badgeColor }} rounded-3 fw-semibold">
                                            {{ ucfirst($roleName) }}
                                        </span>
                                    </td>
                                    {{-- END PERBAIKAN --}}

                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $user->created_at->format('d M Y') }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex gap-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                                Edit
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        @if (request('tanggal'))
                                            Tidak ada user yang bergabung pada tanggal
                                            {{ \Carbon\Carbon::parse(request('tanggal'))->format('d M Y') }}
                                        @else
                                            Belum ada data pengguna.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
