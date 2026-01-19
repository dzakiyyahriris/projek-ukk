<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Pengguna</title>
    <style>
        /* ... (Style tetap sama, tidak perlu diubah) ... */
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header-brand {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            text-transform: uppercase;
            color: #000;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .header-subtitle {
            text-align: center;
            font-size: 16px;
            font-weight: normal;
            color: #333;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .header-date {
            text-align: center;
            font-size: 11px;
            color: #555;
            font-style: italic;
            margin-bottom: 15px;
        }

        hr {
            border: 0;
            border-top: 2px solid #000;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            float: right;
            text-align: center;
            width: 200px;
            margin-top: 40px;
            margin-right: 20px;
        }
    </style>
</head>

<body>

    <div class="header-brand">
        TIKET ASYIKK WISATA SURABAYA
    </div>

    <div class="header-subtitle">
        Laporan Data Pengguna
    </div>

    <div class="header-date">
        Dicetak pada:
        {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') }} WIB
    </div>

    <hr>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th width="10%">Role</th>
                <th width="20%">Tanggal Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center" style="text-transform: capitalize;">
                        {{ $user->role }}
                    </td>
                    <td class="text-center">
                        {{-- Data dari DB biasanya sudah UTC, jadi dikonversi ke Jakarta juga saat ditampilkan --}}
                        {{ \Carbon\Carbon::parse($user->created_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Surabaya, {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y') }}
        </p>
        <p>Mengetahui,</p>
        <br><br><br>
        <p><b>( Admin Utama )</b></p>
    </div>

</body>

</html>
