@extends('layouts.material-dashboard')

@section('title', 'Edit Supplier')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-info text-white">
                    <h5 class="mb-0">Edit Supplier</h5>
                </div>
                <div class="card-body">
                    @include('supplier.form', ['supplier' => $supplier])
                </div>
            </div>
        </div>
    </div>
@endsection
