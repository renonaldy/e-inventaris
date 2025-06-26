@extends('layouts.material-dashboard')
@section('title', 'Barang Masuk')

@section('content')
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Data Barang Masuk</h4>
            <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary d-flex align-items-center px-3 py-2">
                <span class="material-symbols-rounded me-1">add</span> Tambah
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Nama Barang</th>
                        <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Jumlah</th>
                        <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Tanggal</th>
                        <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Keterangan</th>
                        <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangMasuks as $masuk)
                        <tr>
                            <td>{{ $masuk->barang->nama }}</td>
                            <td>{{ $masuk->jumlah }}</td>
                            <td>{{ \Carbon\Carbon::parse($masuk->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $masuk->keterangan ?? '-' }}</td>
                            <td>
                                <form action="{{ route('barang-masuk.destroy', $masuk) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <span class="material-symbols-rounded">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data barang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $barangMasuks->links() }}
        </div>
    </div>
@endsection
