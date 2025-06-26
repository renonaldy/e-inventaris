@extends('layouts.material-dashboard')
@section('title', 'Data Barang')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header px-4 pt-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap mb-3">
                <h4 class="mb-3">Data Barang</h4>

                <div class="d-flex flex-wrap gap-2">
                    <!-- Tombol Tambah Barang -->
                    <a href="{{ route('barang.create') }}" class="btn btn-primary d-flex align-items-center">
                        <span class="material-symbols-rounded me-1">add</span>
                        Tambah
                    </a>

                    <!-- Tombol Import & Export -->
                    <div class="d-flex gap-2 align-items-center">
                        <!-- Form Import -->
                        <form action="{{ route('barang.import') }}" method="POST" enctype="multipart/form-data"
                            class="d-flex gap-2 align-items-center">
                            @csrf
                            <input type="file" name="file" class="form-control form-control-sm" required>
                            <button type="submit" class="btn btn-success btn-sm d-flex align-items-center">
                                <span class="material-symbols-rounded me-1">upload</span>
                                Import
                            </button>
                        </form>

                        <!-- Tombol Export -->
                        <a href="{{ route('barang.export') }}"
                            class="btn btn-outline-danger btn-sm d-flex align-items-center">
                            <span class="material-symbols-rounded me-1">download</span>
                            Export
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <div class="px-4 pt-3">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoriList as $kategori)
                            <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Lokasi</label>
                    <select name="lokasi_penyimpanan_id" class="form-select">
                        <option value="">Semua Lokasi</option>
                        @foreach ($lokasiList as $lokasi)
                            <option value="{{ $lokasi->id }}"
                                {{ request('lokasi_penyimpanan_id') == $lokasi->id ? 'selected' : '' }}>
                                {{ $lokasi->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Cari nama barang...">
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-secondary w-100">Filter</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-danger w-100">Reset</a>
                </div>
            </form>
        </div>

        {{-- Tabel dan pagination tetap sama --}}
        <div class="card-body px-4 pb-4">
            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Kode</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Nama</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Stok</th>
                            {{-- <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Kategori</th> --}}
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Lokasi</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangs as $barang)
                            <tr>
                                <td>{{ $barang->kode }}</td>
                                <td>{{ $barang->nama }}</td>
                                <td>{{ $barang->stok }}</td>
                                {{-- <td>{{ $barang->kategori->nama ?? '-' }}</td> --}}
                                <td>{{ $barang->lokasi->nama ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('barang.edit', $barang) }}" class="btn btn-sm btn-warning me-1">
                                        <span class="material-symbols-rounded">edit</span>
                                    </a>
                                    <form action="{{ route('barang.destroy', $barang) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Yakin hapus data?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <span class="material-symbols-rounded">delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Tidak ada data barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $barangs->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
