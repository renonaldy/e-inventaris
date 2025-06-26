@extends('layouts.material-dashboard')

@section('title', 'Data Kategori')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center pb-0">
            <h6 class="mb-0 text-uppercase text-sm font-weight-bolder">Data Kategori</h6>
            <a href="{{ route('kategori.create') }}" class="btn btn-sm btn-primary">
                <span class="material-symbols-rounded align-middle">add</span> Tambah
            </a>
        </div>

        <div class="card-body px-0 pt-3 pb-2">
            @if (session('success'))
                <div class="alert alert-success mx-4 mb-4">{{ session('success') }}</div>
            @endif

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Nama</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Keterangan</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark text-center"
                                style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategoris as $kategori)
                            <tr>
                                <td class="ps-4 align-middle">
                                    <span class="text-sm fw-semibold text-dark" style="font-family: 'Inter', sans-serif;">
                                        {{ $kategori->nama }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-sm fw-semibold text-dark" style="font-family: 'Inter', sans-serif;">
                                        {{ $kategori->keterangan }}
                                    </span>
                                </td>
                                <td class="text-center pe-4 align-middle">
                                    <a href="{{ route('kategori.edit', $kategori) }}"
                                        class="btn btn-sm btn-warning rounded-circle me-1" title="Edit">
                                        <span class="material-symbols-rounded align-middle">edit</span>
                                    </a>
                                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger rounded-circle" title="Hapus">
                                            <span class="material-symbols-rounded align-middle">delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">Tidak ada data kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 px-4">
                {{ $kategoris->links() }}
            </div>
        </div>
    </div>
@endsection
