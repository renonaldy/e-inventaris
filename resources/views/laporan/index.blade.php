@extends('layouts.material-dashboard')
@section('title', 'Laporan Barang')

@section('content')
    <div class="card p-4">
        <h4 class="mb-4">Laporan Barang</h4>

        {{-- Filter Form --}}
        <form class="row g-3 mb-4" method="GET" action="{{ route('laporan.index') }}">
            <div class="col-md-3">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="from" value="{{ request('from') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="to" value="{{ request('to') }}" class="form-control">
            </div>
            <div class="col-md-6 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary">
                    <span class="material-symbols-rounded align-middle">filter_alt</span> Filter
                </button>
                <a href="{{ route('laporan.pdf', request()->all()) }}" class="btn btn-danger">
                    <span class="material-symbols-rounded align-middle">picture_as_pdf</span> Export PDF
                </a>
                <a href="{{ route('laporan.excel', request()->all()) }}" class="btn btn-success">
                    <span class="material-symbols-rounded align-middle">grid_on</span> Export Excel
                </a>
            </div>
        </form>

        {{-- Barang Masuk --}}
        <div class="mt-4">
            <h5 class="mb-3">Barang Masuk</h5>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Nama</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Jumlah</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Tanggal</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangMasuk as $bm)
                            <tr>
                                <td>{{ $bm->barang->nama }}</td>
                                <td>{{ $bm->jumlah }}</td>
                                <td>{{ \Carbon\Carbon::parse($bm->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $bm->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada data barang masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Barang Keluar --}}
        <div class="mt-5">
            <h5 class="mb-3">Barang Keluar</h5>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Nama</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Jumlah</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Tanggal</th>
                            <th class="mb-0 text-uppercase text-xs font-weight-bolder text-dark">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangKeluar as $bk)
                            <tr>
                                <td>{{ $bk->barang->nama }}</td>
                                <td>{{ $bk->jumlah }}</td>
                                <td>{{ \Carbon\Carbon::parse($bk->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $bk->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada data barang keluar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
