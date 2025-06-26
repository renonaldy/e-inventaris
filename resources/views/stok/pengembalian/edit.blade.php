@extends('layouts.material-dashboard')

@section('title', 'Edit Pengembalian')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Edit Pengembalian</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengembalian.update', $pengembalian->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label>Barang</label>
                    <select name="barang_id" class="form-select" required>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}"
                                {{ $barang->id == $pengembalian->barang_id ? 'selected' : '' }}>
                                {{ $barang->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" value="{{ $pengembalian->jumlah }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $pengembalian->tanggal }}" class="form-control" required>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
