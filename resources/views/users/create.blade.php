@extends('layouts.material-dashboard')

@section('title', 'Tambah User')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header px-4 pt-4">
            <h5 class="mb-0">Tambah User Baru</h5>
        </div>
        <div class="card-body px-4 pb-4">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control" required>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary me-2">
                        <span class="material-symbols-rounded align-middle me-1">arrow_back</span> Batal
                    </a>
                    <button class="btn btn-primary" type="submit">
                        <span class="material-symbols-rounded align-middle me-1">save</span> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
