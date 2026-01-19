@extends('admin.layouts.app')

@section('css')
{{-- CSS Tambahan --}}
@endsection

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
      <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data {{ $title }}</h5>
            <a href="{{ route('tipe_tiket.create') }}" class="btn btn-primary mb-4">Tambah Data {{ $title }}</a>
            <div class="table-responsive">

                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Acara</th>
                            <th>Nama Tiket</th>
                            <th>Stok</th> {{-- KOLOM BARU --}}
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipeTiket as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                
                                {{-- Menampilkan nama acara dari relasi --}}
                                <td>{{ $item->acara->nama ?? 'Acara Tidak Ditemukan' }}</td> 
                                
                                <td>{{ $item->nama }}</td>

                                {{-- MENAMPILKAN STOK DENGAN WARNA --}}
                                <td>
                                    @if($item->stok <= 0)
                                        <span class="badge bg-danger">Habis (0)</span>
                                    @elseif($item->stok < 10)
                                        <span class="badge bg-warning text-dark">{{ $item->stok }}</span>
                                    @else
                                        {{ $item->stok }}
                                    @endif
                                </td>

                                {{-- Format harga ke IDR --}}
                                <td>{{ 'Rp ' . number_format($item->harga, 0, ',', '.') }}</td> 
                                
                                <td>
                                    <a href="{{ route('tipe_tiket.edit', $item->id_ticket_type) }}" class="btn btn-warning btn-sm">Ubah</a>
                                    
                                    <form id="deleteForm{{ $item->id_ticket_type }}" action="{{ route('tipe_tiket.destroy', $item->id_ticket_type) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id_ticket_type }})">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
    
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
                $('#deleteForm' + id).submit();
            } else {
                swal("Data tidak jadi dihapus!", {
                    icon: "error",
                });
            }
        });
    }
</script>
{{-- JS Tambahan --}}
@endsection