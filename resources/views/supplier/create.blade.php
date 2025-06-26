@extends('layouts.material-dashboard')

@section('title', 'Tambah Supplier')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0">Tambah Supplier</h5>
                </div>
                <div class="card-body">
                    @include('supplier.form')
                </div>
            </div>
        </div>
    </div>
@endsection
