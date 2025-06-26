@extends('layouts.material-dashboard')

@section('title', 'Dashboard')

@push('styles')
    <style>
        @media print {
            body {
                background: white !important;
                color: black !important;
            }

            .sidebar,
            .navbar,
            .btn,
            .alert,
            .form-select,
            form,
            .card-header {
                display: none !important;
            }

            .card,
            .card-body {
                border: none !important;
                box-shadow: none !important;
                page-break-inside: avoid;
            }

            .card-body {
                padding: 0.5rem;
            }

            canvas {
                display: block;
                max-width: 100% !important;
            }

            .row>* {
                width: 100% !important;
                float: none !important;
            }

            .pagebreak {
                page-break-before: always;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <!-- Sambutan -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Selamat Datang, {{ auth()->user()->name }}!</h6>
                    <p class="text-sm mb-0">Anda login sebagai <strong>{{ auth()->user()->role }}</strong></p>
                </div>
                <div class="card-body">
                    <p class="text-sm">Gunakan menu di sidebar untuk mengelola data inventaris.</p>
                </div>
            </div>
        </div>

        @if (\App\Models\Barang::where('stok', '<=', 5)->count())
            <div class="col-12 mb-3">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Ada barang dengan stok di bawah minimum (≤ 5).
                    <a href="{{ route('supplier.stok.minimum') }}" class="alert-link">Lihat detail</a>
                </div>
            </div>
        @endif

        <!-- Statistik -->
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h6>Total Barang</h6>
                    <h3>{{ $data['total_barang'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h6>Barang Masuk</h6>
                    <h3>{{ $data['barang_masuk'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h6>Barang Keluar</h6>
                    <h3>{{ $data['barang_keluar'] }}</h3>
                </div>
            </div>
        </div>

        @if (auth()->user()->role === 'admin')
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h6>Total User</h6>
                        <h3>{{ $data['total_user'] }}</h3>
                    </div>
                </div>
            </div>
        @endif

        <!-- Filter -->
        <div class="col-12 mt-3 mb-3">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-auto">
                    <label for="year" class="form-label">Tahun</label>
                    <select name="year" id="year" onchange="this.form.submit()" class="form-select">
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label for="kategori" class="form-label">Kategori Barang</label>
                    <select name="kategori" id="kategori" onchange="this.form.submit()" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoriList as $kategori)
                            <option value="{{ $kategori }}" {{ $selectedKategori == $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mt-3">Filter</button>
                </div>
            </form>
        </div>

        <!-- Tombol Aksi -->
        <div class="col-12 mb-3">
            <button onclick="window.print()" class="btn btn-secondary me-2">
                <i class="fas fa-print"></i> Cetak Tampilan
            </button>
            <a href="{{ route('dashboard.export.pdf', ['year' => $selectedYear, 'kategori' => $selectedKategori]) }}"
                class="btn btn-danger me-2">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            {{-- <a href="{{ route('dashboard.export.excel', ['year' => $selectedYear, 'kategori' => $selectedKategori]) }}"
                class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Excel
            </a> --}}
        </div>

        <!-- Grafik Gabungan -->
        <div class="col-12">
            <div class="row">
                <!-- Grafik Barang Masuk & Keluar -->
                <div class="col-lg-8 col-md-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h6 class="mb-0">Grafik Barang Masuk & Keluar ({{ $selectedYear }})</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="chart-barang" height="100"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Grafik Pie Kategori -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h6 class="mb-0">Barang Masuk per Kategori</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="chart-kategori" style="max-height: 250px;"></canvas>
                            <ul class="mt-3 ps-3 small">
                                @foreach ($kategoriChartLabels as $index => $label)
                                    <li>
                                        <span
                                            style="display:inline-block;width:12px;height:12px;background-color:{{ $kategoriChartColors[$index % count($kategoriChartColors)] }};margin-right:5px;"></span>
                                        {{ $label }}: {{ $kategoriChartData[$index] }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaPH0qYj47B3KRtP5CyMiW5oZXynfXbKhNBwuhyRILP0m8RzRM28XlDxzqQqWyw5cMzjlZmv3dy6kzgsPNQkQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const ctx = document.getElementById('chart-barang').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Barang Masuk',
                    data: {!! json_encode($barangMasukChart) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderRadius: 4
                }, {
                    label: 'Barang Keluar',
                    data: {!! json_encode($barangKeluarChart) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Barang'
                        }
                    }
                }
            }
        });

        const ctx2 = document.getElementById('chart-kategori').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: {!! json_encode($kategoriChartLabels) !!},
                datasets: [{
                    label: 'Barang Masuk',
                    data: {!! json_encode($kategoriChartData) !!},
                    backgroundColor: {!! json_encode($kategoriChartColors) !!}
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        window.addEventListener('beforeprint', () => {
            ['chart-barang', 'chart-kategori'].forEach(id => {
                const el = document.getElementById(id);
                html2canvas(el).then(canvas => {
                    el.replaceWith(canvas);
                });
            });
        });
    </script>
@endpush
