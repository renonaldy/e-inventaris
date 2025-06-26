<!DOCTYPE html>
<html>

<head>
    <title>Laporan Dashboard - {{ $selectedYear }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }

        h2 {
            margin-bottom: 0;
        }
    </style>
</head>

<body>

    <h2>Laporan Barang Masuk dan Keluar - {{ $selectedYear }}</h2>

    <h4>Barang Masuk</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangMasuk as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 style="margin-top:20px;">Barang Keluar</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangKeluar as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
