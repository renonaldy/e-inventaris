@extends('layouts.material-dashboard')

@section('title', 'Manajemen Backup')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center px-4 pt-4">
            <h5 class="mb-0">Manajemen Backup</h5>
            <form action="{{ route('backup.create') }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-primary">
                    <span class="material-symbols-rounded align-middle">backup</span> Buat Backup Baru
                </button>
            </form>
        </div>

        <div class="card-body px-4 pb-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-uppercase text-xs text-dark">Nama File</th>
                            <th class="text-uppercase text-xs text-dark">Ukuran</th>
                            <th class="text-uppercase text-xs text-dark text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($files as $file)
                            <tr>
                                <td class="text-sm">{{ basename($file) }}</td>
                                <td class="text-sm">{{ number_format(Storage::disk('public')->size($file) / 1024, 2) }} KB
                                </td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/' . $file) }}" download class="btn btn-sm btn-success me-1">
                                        <span class="material-symbols-rounded align-middle">download</span>
                                    </a>

                                    <form action="{{ route('backup.destroy', basename($file)) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Hapus file ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <span class="material-symbols-rounded align-middle">delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada file backup.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
