<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data</title>
    <style>
        body {
            font-family: sans-serif;
        }

        /* --- STYLE HEADER --- */
        .header-brand {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .header-title {
            text-align: center;
            font-size: 16px;
            margin-top: 0;
            margin-bottom: 5px;
            font-weight: normal;
        }

        .header-date {
            text-align: center;
            font-size: 12px;
            color: #555;
            margin-top: 0;
            margin-bottom: 20px;
            font-style: italic;
        }

        hr {
            border: 0;
            border-top: 1px solid #333;
            margin-bottom: 20px;
        }

        /* --- TABEL --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #eee;
            text-align: center;
            font-weight: bold;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        .footer {
            float: right;
            text-align: center;
            width: 200px;
            margin-top: 30px;
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <div class="header-brand">TIKET ASYIKK WISATA SURABAYA</div>
    <div class="header-title">{{ $title }}</div>

    {{-- FIX 1: WAKTU CETAK (Pakai timezone Asia/Jakarta) --}}
    <p class="header-date">
        Dicetak pada: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB
    </p>

    <hr>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                {{-- Pilihan Header sesuai Data --}}
                @if (isset($users))
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tanggal Bergabung</th>
                @else
                    <th>Kode Pesanan</th>
                    <th width="30%">Tanggal Transaksi</th>
                    <th width="25%">Total Bayar</th>
                @endif
            </tr>
        </thead>
        <tbody>
            {{-- ISI DATA --}}
            @if (isset($users))
                {{-- LOOP DATA USER --}}
                @foreach ($users as $user)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">{{ $user->role }}</td>
                        <td class="text-center">
                            {{-- FIX 2: TANGGAL USER JOIN --}}
                            {{ \Carbon\Carbon::parse($user->created_at)->timezone('Asia/Jakarta')->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                @endforeach
            @elseif(isset($data_pesanan))
                {{-- LOOP DATA PESANAN --}}
                @foreach ($data_pesanan as $key => $item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>#{{ $item->kode_pesanan ?? ($item->kode_invoice ?? '-') }}</td>
                        <td class="text-center">
                            {{-- FIX 3: JAM TRANSAKSI (Penting agar tidak jam 3 pagi tapi jam 10 pagi) --}}
                            {{ $item->created_at->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}
                        </td>
                        <td class="text-right">
                            Rp {{ number_format($item->jumlah_total ?? ($item->total_harga ?? 0), 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="footer">
        {{-- FIX 4: TANGGAL TANDA TANGAN --}}
        <p>Surabaya, {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->translatedFormat('d F Y') }}</p>
        <p>Mengetahui,</p>
        <br><br><br>
        <p><b>( Admin Pengelola )</b></p>
    </div>

</body>
</html>