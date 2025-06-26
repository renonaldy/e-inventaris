<!-- resources/views/pengembalian/index.blade.php -->

@extends('layouts.material-dashboard')

@section('title', 'Data Pengembalian')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Pengembalian</h5>
                    <div>
                        <a href="{{ route('pengembalian.create') }}" class="btn btn-primary">+ Tambah</a>
                        <a href="{{ route('pengembalian.export') }}" class="btn btn-success">Export Excel</a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengembalians as $i => $item)
                                <tr>
                                    <td>{{ $pengembalians->firstItem() + $i }}</td>
                                    <td>{{ $item->barang->nama }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->catatan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $pengembalians->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
