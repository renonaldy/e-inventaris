<!-- resources/views/layouts/material-dashboard.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />

    <!-- Core CSS -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom Styling -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #344767;
        }

        /* Table Header */
        table thead th {
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #8392ab !important;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        /* Table Body */
        table tbody td {
            font-weight: 400;
            font-size: 14px;
            color: #344767;
            vertical-align: middle;
            padding: 0.75rem 1rem;
        }

        .table-responsive {
            border-radius: 0.5rem;
            overflow-x: auto;
        }

        /* Buttons */
        .btn-sm .material-symbols-rounded {
            font-size: 18px;
            vertical-align: middle;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        /* Text Color Utilities */
        .text-secondary {
            color: #8392ab !important;
        }

        .text-dark {
            color: #344767 !important;
        }

        /* ==== Custom Form Styling ==== */
        .form-control {
            background-color: #f5f7fa !important;
            border: 1px solid #d2d6da;
            color: #344767;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #cb0c9f;
            box-shadow: 0 0 0 2px rgba(203, 12, 159, 0.2);
            outline: none;
        }

        label.form-label {
            font-weight: 600;
            color: #344767;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
        }

        /* Button Primary Override */
        .btn-primary {
            background-color: #cb0c9f;
            border-color: #cb0c9f;
        }

        .btn-primary:hover {
            background-color: #ad0a8a;
            border-color: #ad0a8a;
        }

        /* Button Secondary */
        .btn-outline-secondary {
            color: #67748e;
            border-color: #d2d6da;
        }

        .btn-outline-secondary:hover {
            background-color: #f0f2f5;
        }
    </style>

    @stack('styles')
</head>

<body class="g-sidenav-show bg-gray-100">
    @include('partials.sidebar')

    <main class="main-content border-radius-lg">
        @include('partials.navbar')

        <div class="container-fluid py-2">
            @yield('content')
        </div>

        @include('partials.footer')
    </main>

    <!-- Core JS -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>

    @stack('scripts')
</body>

</html>
