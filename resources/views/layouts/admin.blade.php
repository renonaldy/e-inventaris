<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="{{ asset('assets/css/material-dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        @include('partials.sidebar')
        <div class="main-panel">
            @include('partials.navbar')
            <div class="content">
                @yield('content')
            </div>
            @include('partials.footer')
        </div>
    </div>
    <script src="{{ asset('assets/js/material-dashboard.js') }}"></script>
</body>
</html>
