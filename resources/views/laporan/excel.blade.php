<table>
    <thead>
        <tr>
            <th colspan="4">Barang Masuk</th>
        </tr>
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

<table>
    <thead>
        <tr>
            <th colspan="4">Barang Keluar</th>
        </tr>
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
