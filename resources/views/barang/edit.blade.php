@extends('layouts.material-dashboard')
@section('title', 'Edit Barang')

@section('content')
    <div class="card p-4">
        <h4 class="mb-3">Edit Barang</h4>
        <form action="{{ route('barang.update', $barang) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" name="nama" class="form-control" value="{{ $barang->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" name="kode" class="form-control" value="{{ $barang->kode }}" readonly>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" value="{{ $barang->satuan }}" required>
            </div>
            <div class="mb-3">
                <label for="lokasi_penyimpanan_id" class="form-label">Lokasi Penyimpanan</label>
                <select name="lokasi_penyimpanan_id" id="lokasi_penyimpanan_id" class="form-select">
                    <option value="">-- Pilih Lokasi --</option>
                    @foreach ($lokasis as $lokasi)
                        <option value="{{ $lokasi->id }}"
                            {{ old('lokasi_penyimpanan_id', $barang->lokasi_penyimpanan_id) == $lokasi->id ? 'selected' : '' }}>
                            {{ $lokasi->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="stok_minimum" class="form-label">Stok Minimum</label>
                <input type="number" name="stok_minimum" class="form-control"
                    value="{{ old('stok_minimum', $barang->stok_minimum ?? 5) }}">
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ $barang->keterangan }}</textarea>
            </div>
            <button class="btn btn-success">Perbarui</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
