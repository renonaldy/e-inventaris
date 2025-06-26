@extends('layouts.material-dashboard')
@section('title', 'Tambah Lokasi Penyimpanan')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header px-4 pt-4">
            <h5 class="mb-0">Tambah Lokasi Penyimpanan</h5>
        </div>
        <div class="card-body px-4 pb-4">
            <form action="{{ route('lokasi.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lokasi</label>
                    <input type="text" class="form-control" name="nama" id="nama" required>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('lokasi.index') }}" class="btn btn-outline-secondary me-2">
                        <span class="material-symbols-rounded align-middle me-1">arrow_back</span> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-rounded align-middle me-1">save</span> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
