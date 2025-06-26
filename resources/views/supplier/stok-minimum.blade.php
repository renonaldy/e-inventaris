@extends('layouts.material-dashboard')

@section('title', 'Peringatan Stok Minimum')

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <h4 class="text-danger">⚠️ Daftar Barang dengan Stok Minimum (≤ 5)</h4>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    @if ($barangs->count())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $i => $barang)
                                    <tr class="{{ $barang->stok <= 2 ? 'table-danger' : 'table-warning' }}">
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td>{{ $barang->kategori }}</td>
                                        <td>{{ $barang->stok }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Tidak ada barang dengan stok minimum.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
