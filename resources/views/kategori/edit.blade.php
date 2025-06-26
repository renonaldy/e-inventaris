@extends('layouts.material-dashboard')
@section('title', 'Edit Kategori')

@section('content')
    <div class="card shadow-sm border-0 p-4">
        <h4 class="mb-3 text-dark">Edit Kategori</h4>

        <form action="{{ route('kategori.update', $kategori) }}" method="POST">
            @csrf
            @method('PUT')
            @include('kategori.form')

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary me-2">
                    <span class="material-symbols-rounded align-middle me-1">arrow_back</span> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <span class="material-symbols-rounded align-middle me-1">save</span> Update
                </button>
            </div>
        </form>
    </div>
@endsection
