@extends('layouts.material-dashboard')
@section('title', 'Tambah Barang Masuk')

@section('content')
    <div class="card p-4">
        <h4 class="mb-3">Tambah Barang Masuk</h4>

        <form action="{{ route('barang-masuk.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Barang</label>
                <select name="barang_id" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('barang-masuk.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
