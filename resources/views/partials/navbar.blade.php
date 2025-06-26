<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="#">Aplikasi</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('title', 'Dashboard')</li>
            </ol>
        </nav>
        <ul class="navbar-nav d-flex align-items-center justify-content-end ms-auto">
            <li class="nav-item d-flex align-items-center">
                <span class="nav-link text-body font-weight-bold">
                    <i class="material-symbols-rounded">account_circle</i>
                    {{ auth()->user()->name }}
                </span>
            </li>
        </ul>
    </div>
</nav>
