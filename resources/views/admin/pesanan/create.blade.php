@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Buat {{ $title }} Baru</h5>

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('pesanan.store') }}" method="POST">
                    @csrf

                    {{-- 1. Pilih Pelanggan --}}
                    <div class="mb-4">
                        <label for="user_id" class="form-label fw-bold">1. Pilih Pelanggan</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id"
                            required>
                            <option value="">-- Pilih Pelanggan (User) --</option>
                            @foreach ($pelanggan as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    {{-- 2. Daftar Item Tiket (Dinamis) --}}
                    <h5 class="fw-bold mb-3">2. Pilih Tipe Tiket & Jumlah</h5>
                    <div id="ticket-items-container">
                        {{-- Baris item tiket akan ditambahkan di sini --}}
                    </div>

                    <button type="button" id="add-item-btn" class="btn btn-info btn-sm mb-4 text-white">
                        <i class="fas fa-plus"></i> Tambah Tiket Lain
                    </button>

                    <hr class="my-4">

                    {{-- 3. Total Harga (Auto-calculated) --}}
                    <div class="mb-5">
                        <label class="form-label fw-bold">3. Total Harga</label>
                        <input type="text" class="form-control" id="total_harga_display" value="Rp 0" readonly
                            style="font-size: 1.8rem; background-color: #f8f9fa;">
                    </div>

                    <button type="submit" class="btn btn-success btn-lg">Proses Pesanan (Status: Lunas)</button>
                    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary btn-lg">Batal</a>
                </form>

            </div>
        </div>
    </div>

    {{-- Template untuk Baris Tiket Baru (Gunakan Script untuk mencegah rendering) --}}
    <script id="ticket-item-template" type="text/template">
    <div class="row mb-3 ticket-item border p-3 rounded" data-index="__INDEX__">
        <div class="col-md-5 mb-3 mb-md-0">
            <label class="form-label">Tipe Tiket</label>
            <select class="form-select ticket-select" name="items[__INDEX__][ticket_type_id]" required>
                <option value="">-- Pilih Tipe Tiket --</option>
                @foreach ($tipeTiket as $tiket)
                    <option 
                        value="{{ $tiket->id_ticket_type }}" 
                        data-harga="{{ $tiket->harga }}">
                        [{{ $tiket->acara->nama ?? 'Acara Dihapus' }}] - {{ $tiket->nama }} (Rp {{ number_format($tiket->harga, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
            @error('items.__INDEX__.ticket_type_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <label class="form-label">Jumlah</label>
            <input type="number" class="form-control quantity-input" name="items[__INDEX__][jumlah_tiket]" value="1" min="1" required>
            @error('items.__INDEX__.jumlah_tiket') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Subtotal</label>
            <input type="text" class="form-control subtotal-display" value="Rp 0" readonly>
        </div>
        <div class="col-md-1 d-flex align-items-end">
    <button type="button" class="btn btn-danger remove-item-btn w-100" title="Hapus Baris">
        hapus
        {{-- Jika Anda masih ingin ikonnya muncul di depan teks: --}}
        {{-- <i class="fas fa-trash"></i> hapus --}}
    </button>
</div>
    </div>
</script>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> {{-- Membutuhkan jQuery --}}
    <script>
        $(document).ready(function() {
            let itemIndex = 0;
            const container = $('#ticket-items-container');
            const template = $('#ticket-item-template').html();
            const totalDisplay = $('#total_harga_display');

            function formatRupiah(number) {
                return 'Rp ' + number.toLocaleString('id-ID');
            }

            function calculateTotal() {
                let grandTotal = 0;

                // Loop melalui setiap item tiket yang ada
                container.find('.ticket-item').each(function() {
                    const item = $(this);
                    const select = item.find('.ticket-select');
                    const quantity = parseInt(item.find('.quantity-input').val()) || 0;

                    const selectedOption = select.find('option:selected');
                    const harga = parseFloat(selectedOption.data('harga')) || 0;

                    const subtotal = harga * quantity;
                    grandTotal += subtotal;

                    // Update subtotal display
                    item.find('.subtotal-display').val(formatRupiah(subtotal));
                });

                // Update grand total
                totalDisplay.val(formatRupiah(grandTotal));
            }

            function addItem() {
                // Ganti placeholder __INDEX__ dengan nilai index saat ini
                const newItemHtml = template.replace(/__INDEX__/g, itemIndex);
                container.append(newItemHtml);
                itemIndex++;
                calculateTotal();
            }

            // Tambahkan baris pertama secara otomatis saat memuat halaman
            addItem();

            // Event listener untuk tombol 'Tambah Tiket Lain'
            $('#add-item-btn').on('click', function() {
                addItem();
            });

            // Event listener untuk menghapus baris
            container.on('click', '.remove-item-btn', function() {
                // Hapus elemen induk (.ticket-item)
                $(this).closest('.ticket-item').remove();
                calculateTotal();
            });

            // Event listener untuk perubahan pada select (tipe tiket) atau input (jumlah)
            container.on('change', '.ticket-select', calculateTotal);
            container.on('input', '.quantity-input', calculateTotal);
        });
    </script>
@endsection
