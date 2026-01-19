@extends('admin.layouts.app')

@section('css')
    {{-- CSS Tambahan --}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data {{ $title }}</h5>

            <a href="{{ route('item.create') }}" class="btn btn-primary mb-4">Tambah Data {{ $title }}</a>

            {{-- Menampilkan SweetAlert jika ada sesi flash (Success/Danger) --}}
            @if (session('status'))
                <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">{{ session('title') }}</h4>
                    <p>{{ session('message') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            

            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Kategori</th>
                            <th>Kode Unik</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if ($item->photo)
                                        <a href="{{ asset('photos/' . $item->photo) }}" target="_blank">Lihat Foto</a>
                                    @else
                                        Tidak Ada Foto
                                    @endif
                                </td>
                                {{-- Menggunakan relasi category --}}
                                <td>{{ $item->category->name ?? 'N/A' }}</td>
                                <td>{{ $item->unique_code ?? '-' }}</td>
                                <td>
                                    @php
                                        $badgeClass = $item->condition === 'Baik' ? 'bg-success' : 'bg-danger';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $item->condition }}</span>
                                </td>
                                <td>
                                    {{-- Tombol Ubah (Edit) --}}
                                    <a href="{{ route('item.edit', $item->id) }}" class="btn btn-warning btn-sm">Ubah</a>

                                    {{-- Form untuk Hapus --}}
                                    <form id="deleteForm{{ $item->id }}"
                                        action="{{ route('item.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- Pastikan Anda sudah memuat library SweetAlert dan jQuery/DataTables --}}
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            $('#datatable').DataTable();
        });

        // Script untuk SweetAlert konfirmasi hapus
        function confirmDelete(id) {
            swal({
                    title: "Apakah anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Jika pengguna menekan "OK", submit form
                        $('#deleteForm' + id).submit();
                    } else {
                        // Jika pengguna menekan "Cancel"
                        swal("Data tidak jadi dihapus!", {
                            icon: "error",
                        });
                    }
                });
        }
    </script>
@endsection
