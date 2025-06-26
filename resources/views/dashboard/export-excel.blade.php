<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barangMasuk as $item)
            <tr>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->barang->nama }}</td>
                <td>{{ $item->barang->kategori->nama ?? '-' }}</td>
                <td>{{ $item->jumlah }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
