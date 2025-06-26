@extends('layouts.material-dashboard')

@section('title', 'Manajemen Users')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center px-4 pt-4">
            <h5 class="mb-0">Daftar Users</h5>
            <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User</a>
        </div>
        <div class="card-body px-4 pb-4 table-responsive">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table align-items-center mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-uppercase text-xs font-weight-bolder text-dark">Nama</th>
                        <th class="text-uppercase text-xs font-weight-bolder text-dark">Email</th>
                        <th class="text-uppercase text-xs font-weight-bolder text-dark">Role</th>
                        <th class="text-uppercase text-xs font-weight-bolder text-dark text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-sm text-dark">{{ $user->name }}</td>
                            <td class="text-sm text-dark">{{ $user->email }}</td>
                            <td>
                                @php
                                    $badgeClass = match ($user->role) {
                                        'admin' => 'bg-gradient-success',
                                        'kurir' => 'bg-gradient-info',
                                        'pelanggan' => 'bg-gradient-success',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} text-white text-xm px-2 py-1 rounded-pill">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning me-1">
                                    <span class="material-symbols-rounded align-middle">edit</span>
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block"
                                    onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <span class="material-symbols-rounded align-middle">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
