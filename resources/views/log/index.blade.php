@extends('layouts.material-dashboard')

@section('title', 'Log Aktivitas')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header px-4 pt-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Log Aktivitas</h5>
        </div>

        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-uppercase text-xs font-weight-bolder text-dark">Waktu</th>
                            <th class="text-uppercase text-xs font-weight-bolder text-dark">User</th>
                            <th class="text-uppercase text-xs font-weight-bolder text-dark">Aktivitas</th>
                            <th class="text-uppercase text-xs font-weight-bolder text-dark">Model</th>
                            <th class="text-uppercase text-xs font-weight-bolder text-dark text-center">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td class="text-sm text-dark">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-sm text-dark">{{ $log->user->name ?? '-' }}</td>
                                <td class="text-sm text-dark">
                                    <span class="badge bg-gradient-info">{{ ucfirst($log->activity) }}</span>
                                </td>
                                <td class="text-sm text-secondary">{{ $log->model }}</td>
                                <td class="text-sm text-secondary">{{ $log->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Tidak ada log aktivitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
@endsection
