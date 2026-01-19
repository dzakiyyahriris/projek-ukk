<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota - {{ $pesanan->kode_pesanan }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
        }

        .company-details h2 {
            margin: 0;
            color: #333;
            text-transform: uppercase;
        }

        .company-details p {
            margin: 0;
            font-size: 12px;
            color: #777;
        }

        .invoice-details {
            text-align: right;
        }

        .invoice-details h3 {
            margin: 0;
            color: #555;
        }

        .invoice-details p {
            margin: 0;
            font-size: 12px;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .user-info table {
            width: 100%;
        }

        .user-info td {
            padding: 5px 0;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th {
            background: #f8f9fa;
            border-bottom: 2px solid #ddd;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }

        .items-table td {
            border-bottom: 1px solid #eee;
            padding: 10px;
        }

        .items-table .total-row td {
            border-top: 2px solid #333;
            font-weight: bold;
            font-size: 16px;
        }

        .status-paid {
            color: green;
            border: 2px solid green;
            padding: 5px 10px;
            text-transform: uppercase;
            font-weight: bold;
            display: inline-block;
            transform: rotate(-5deg);
        }

        .status-unpaid {
            color: red;
            border: 2px solid red;
            padding: 5px 10px;
            text-transform: uppercase;
            font-weight: bold;
            display: inline-block;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        /* Styling khusus saat diprint */
        @media print {
            body {
                background-color: #fff;
                padding: 0;
            }

            .invoice-box {
                box-shadow: none;
                border: 0;
                padding: 0;
                max-width: 100%;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div style="text-align: center; margin-bottom: 20px;" class="no-print">
        <button onclick="window.print()"
            style="padding: 10px 20px; cursor: pointer; background: #007bff; color: white; border: none; border-radius: 5px;">
            Cetak Halaman Ini
        </button>
    </div>

    <div class="invoice-box">
        <div class="header">
            <div class="company-details">
                <h2>Tiket Wisata Surabaya</h2>
                <p>Jl. Contoh Wisata No. 123, Surabaya</p>
                <p>Email: admin@wisatasurabaya.com | Telp: (031) 123-4567</p>
            </div>
            <div class="invoice-details">
                <h3>NOTA PEMBAYARAN</h3>
                <p>No: <strong>{{ $pesanan->kode_pesanan }}</strong></p>
                <p>Tanggal: {{ \Carbon\Carbon::parse($pesanan->created_at)->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <div class="user-info">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td width="60%" valign="top">
                        <strong>Kepada Yth:</strong><br>
                        {{ $pesanan->user->name ?? 'Pengunjung Umum' }}<br>
                        <small>{{ $pesanan->user->email ?? '-' }}</small>
                    </td>
                    <td width="40%" valign="top" style="text-align: right;">
                        <strong>Status Pembayaran:</strong><br><br>
                        @if (strtolower($pesanan->status) == 'lunas' || strtolower($pesanan->status) == 'paid')
                            <span class="status-paid">LUNAS</span>
                        @else
                            <span class="status-unpaid">{{ strtoupper($pesanan->status) }}</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Deskripsi Item</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Harga Satuan</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                {{-- 
                    PERBAIKAN UTAMA:
                    Menghapus @foreach karena data tersimpan di tabel pesanan utama,
                    bukan di tabel relasi item.
                --}}
                <tr>
                    <td>
                        {{-- Nama Acara --}}
                        <strong>{{ $pesanan->acara->nama ?? 'Nama Wisata Tidak Ditemukan' }}</strong>
                        <br>

                        {{-- Tipe Tiket --}}
                        <span style="color: #555;">
                            Tipe: {{ $pesanan->tipeTiket->nama_tipe ?? 'Regular' }}
                        </span>
                        <br>

                        {{-- Tanggal Kunjungan --}}
                        <small style="color: #777;">
                            Kunjungan:
                            @if (!empty($pesanan->tanggal_kunjungan))
                                {{ \Carbon\Carbon::parse($pesanan->tanggal_kunjungan)->translatedFormat('d M Y') }}
                            @else
                                -
                            @endif
                        </small>
                    </td>

                    {{-- Jumlah Tiket --}}
                    <td style="text-align: center;">{{ $pesanan->jumlah_tiket }}</td>

                    {{-- Harga Satuan (Ambil dari Relasi TipeTiket) --}}
                    <td style="text-align: right;">
                        Rp {{ number_format($pesanan->tipeTiket->harga ?? 0, 0, ',', '.') }}
                    </td>

                    {{-- Total Bayar --}}
                    <td style="text-align: right;">
                        Rp {{ number_format($pesanan->jumlah_total, 0, ',', '.') }}
                    </td>
                </tr>

                {{-- Baris Total Bawah --}}
                <tr class="total-row">
                    <td colspan="3" style="text-align: right; padding-right: 20px;">Total Bayar</td>
                    <td style="text-align: right;">Rp {{ number_format($pesanan->jumlah_total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Terima kasih atas kunjungan Anda di Wisata Surabaya.</p>
            <p>Harap tunjukkan nota ini di loket masuk.</p>
        </div>
    </div>

    <script>
        // Opsional: Otomatis print saat halaman dibuka
        // window.onload = function() { window.print(); }
    </script>
</body>

</html>
