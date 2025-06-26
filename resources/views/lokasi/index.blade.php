@extends('layouts.material-dashboard')
@section('title', 'Lokasi Penyimpanan')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center px-4 pt-4">
            <h5 class="mb-0">Data Lokasi Penyimpanan</h5>
            <a href="{{ route('lokasi.create') }}" class="btn btn-sm btn-primary">
                <span class="material-symbols-rounded align-middle">add</span> Tambah Lokasi
            </a>
        </div>
        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-uppercase text-xs font-weight-bolder text-dark">Nama</th>
                            <th class="text-uppercase text-xs font-weight-bolder text-dark">Keterangan</th>
                            <th class="text-uppercase text-xs font-weight-bolder text-dark text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lokasis as $lokasi)
                            <tr>
                                <td class="text-sm text-dark">{{ $lokasi->nama }}</td>
                                <td class="text-sm text-secondary">{{ $lokasi->keterangan }}</td>
                                <td class="text-center">
                                    <a href="{{ route('lokasi.edit', $lokasi) }}" class="btn btn-sm btn-warning me-1">
                                        <span class="material-symbols-rounded align-middle">edit</span>
                                    </a>
                                    <form action="{{ route('lokasi.destroy', $lokasi) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <span class="material-symbols-rounded align-middle">delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $lokasis->links() }}
            </div>
        </div>
    </div>
@endsection
