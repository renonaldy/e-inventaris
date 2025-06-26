<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h3>Laporan Barang Masuk</h3>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangMasuk as $bm)
                <tr>
                    <td>{{ $bm->barang->nama }}</td>
                    <td>{{ $bm->jumlah }}</td>
                    <td>{{ $bm->tanggal }}</td>
                    <td>{{ $bm->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Laporan Barang Keluar</h3>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangKeluar as $bk)
                <tr>
                    <td>{{ $bk->barang->nama }}</td>
                    <td>{{ $bk->jumlah }}</td>
                    <td>{{ $bk->tanggal }}</td>
                    <td>{{ $bk->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
