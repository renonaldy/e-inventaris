@extends('layouts.material-dashboard')

@section('title', 'Grafik Stok per Kategori')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Grafik Stok Barang per Kategori</h6>
                </div>
                <div class="card-body">
                    <canvas id="chartStokKategori" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const ctxStok = document.getElementById('chartStokKategori').getContext('2d');
        new Chart(ctxStok, {
            type: 'bar',
            data: {
                labels: {!! json_encode($kategoriLabels) !!},
                datasets: [{
                    label: 'Stok Barang',
                    data: {!! json_encode($stokData) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Stok'
                        }
                    }
                }
            }
        });
    </script>
@endpush
