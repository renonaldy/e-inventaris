@extends('layouts.material-dashboard')

@section('title', 'Edit User')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header px-4 pt-4">
            <h5 class="mb-0">Edit User</h5>
        </div>
        <div class="card-body px-4 pb-4">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password <small class="text-muted">(biarkan kosong jika tidak
                            ingin ganti)</small></label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                    <button class="btn btn-primary" type="submit">
                        <span class="material-symbols-rounded align-middle me-1">save</span> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
