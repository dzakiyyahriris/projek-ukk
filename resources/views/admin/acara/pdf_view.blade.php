<!DOCTYPE html>
<html>

<head>
    <title>Tiket Wisata Surabaya</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-top: 0;
            font-size: 14px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <h2>Tiket Asyikk Wisata Surabaya</h2>
    <p>Laporan Data Acara</p>

    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th width="5%">No</th>
                <th>Nama Acara</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_acara as $item)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td align="center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
