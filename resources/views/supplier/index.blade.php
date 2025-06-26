@extends('layouts.material-dashboard')

@section('title', 'Data Supplier')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h4 class="mb-0">Data Supplier</h4>
            <div class="d-flex gap-2">
                @can('admin')
                    <a href="{{ route('supplier.index') }}" class="btn btn-outline-primary">Kelola Supplier</a>
                @endcan
                <a href="{{ route('supplier.create') }}" class="btn btn-primary">
                    <span class="material-symbols-rounded align-middle">add</span>
                    Tambah Supplier
                </a>
            </div>
        </div>

        {{-- Form Pencarian --}}
        <form method="GET" action="{{ route('supplier.index') }}" class="mb-4">
            <div class="input-group w-50">
                <input type="text" name="search" class="form-control bg-light border"
                    placeholder="Cari nama supplier..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tabel Supplier --}}
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table align-items-center mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-uppercase text-dark text-xs font-weight-bolder">No</th>
                            <th class="text-uppercase text-dark text-xs font-weight-bolder">Nama Supplier</th>
                            <th class="text-uppercase text-dark text-xs font-weight-bolder">Alamat</th>
                            <th class="text-uppercase text-dark text-xs font-weight-bolder">Telepon</th>
                            <th class="text-uppercase text-dark text-xs font-weight-bolder text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $i => $supplier)
                            <tr>
                                <td class="text-sm text-dark">{{ $suppliers->firstItem() + $i }}</td>
                                <td class="text-sm fw-semibold text-dark">{{ $supplier->nama }}</td>
                                <td class="text-sm text-dark">{{ $supplier->alamat ?? '-' }}</td>
                                <td class="text-sm text-dark">{{ $supplier->telepon ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('supplier.edit', $supplier->id) }}"
                                        class="btn btn-sm btn-warning rounded-pill px-3 me-1">
                                        <span class="material-symbols-rounded align-middle">edit</span>
                                    </a>
                                    @can('admin-only')
                                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger rounded-pill px-3">
                                                <span class="material-symbols-rounded align-middle">delete</span>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Tidak ada data supplier.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $suppliers->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
