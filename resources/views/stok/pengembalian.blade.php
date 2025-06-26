@extends('layouts.material-dashboard')

@section('title', 'Pengembalian Barang')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Pengembalian Barang</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="barang_id" class="form-label">Barang</label>
                    <select name="barang_id" id="barang_id" class="form-select">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Pengembalian</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1">
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Pengembalian</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
