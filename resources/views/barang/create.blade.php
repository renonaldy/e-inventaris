@extends('layouts.material-dashboard')
@section('title', 'Tambah Barang')

@section('content')
    <div class="card p-4">
        <h4 class="mb-3">Tambah Barang</h4>
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            {{-- <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div> --}}
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
            </div>

            {{-- <div class="mb-3">
                <label>Kode Barang</label>
                <input type="text" name="kode" class="form-control" value="{{ $kode }}" readonly>
            </div> --}}
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="lokasi_penyimpanan_id" class="form-label">Lokasi Penyimpanan</label>
                <select name="lokasi_penyimpanan_id" id="lokasi_penyimpanan_id" class="form-select">
                    <option value="">-- Pilih Lokasi --</option>
                    @foreach ($lokasis as $lokasi)
                        <option value="{{ $lokasi->id }}"
                            {{ old('lokasi_penyimpanan_id') == $lokasi->id ? 'selected' : '' }}>
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
                <textarea name="keterangan" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
