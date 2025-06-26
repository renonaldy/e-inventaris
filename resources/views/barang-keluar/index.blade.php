@extends('layouts.material-dashboard')
@section('title', 'Barang Keluar')

@section('content')
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Data Barang Keluar</h4>
            <a href="{{ route('barang-keluar.create') }}" class="btn btn-primary d-flex align-items-center px-3 py-2">
                <span class="material-symbols-rounded me-1">add</span> Tambah
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
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
                    @forelse ($barangKeluars as $keluar)
                        <tr>
                            <td>{{ $keluar->barang->nama }}</td>
                            <td>{{ $keluar->jumlah }}</td>
                            <td>{{ \Carbon\Carbon::parse($keluar->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $keluar->keterangan ?? '-' }}</td>
                            <td>
                                <form action="{{ route('barang-keluar.destroy', $keluar) }}" method="POST"
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
                            <td colspan="5" class="text-center text-muted">Tidak ada data barang keluar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $barangKeluars->links() }}
        </div>
    </div>
@endsection
