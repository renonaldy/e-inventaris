@extends('layouts.material-dashboard')

@section('title', 'Riwayat Stok Barang')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Riwayat Stok Barang</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Stok Sekarang</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $barang->nama }}</td>
                            <td>{{ $barang->kategori }}</td>
                            <td>{{ $barang->supplier->nama ?? '-' }}</td>
                            <td>{{ $barang->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
