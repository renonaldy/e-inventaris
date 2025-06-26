@php
    $user = auth()->user();
@endphp

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="#" target="_blank">
            <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26"
                alt="main_logo">
            <span class="ms-1 text-sm text-dark">E-Inventaris</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            {{-- Dashboard --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                    href="{{ route('dashboard') }}">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            {{-- Kategori --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                    href="{{ route('kategori.index') }}">
                    <i class="material-symbols-rounded opacity-5">category</i>
                    <span class="nav-link-text ms-1">Kategori</span>
                </a>
            </li>

            {{-- Lokasi Penyimpanan --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lokasi.*') || request()->routeIs('lokasi-penyimpanan.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                    href="{{ route('lokasi.index') }}">
                    <i class="material-symbols-rounded opacity-5">location_on</i>
                    <span class="nav-link-text ms-1">Lokasi Penyimpanan</span>
                </a>
            </li>

            {{-- Supplier --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('supplier.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                    href="{{ route('supplier.index') }}">
                    <i class="material-symbols-rounded opacity-5">local_shipping</i>
                    <span class="nav-link-text ms-1">Supplier</span>
                </a>
            </li>

            {{-- Barang --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('barang.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                    href="{{ route('barang.index') }}">
                    <span class="material-symbols-rounded opacity-5">inventory_2</span>
                    <span class="nav-link-text ms-1">Barang</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('barang-masuk.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                    href="{{ route('barang-masuk.index') }}">
                    <span class="material-symbols-rounded opacity-5">download</span>
                    <span class="nav-link-text ms-1">Barang Masuk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('barang-keluar.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                    href="{{ route('barang-keluar.index') }}">
                    <span class="material-symbols-rounded opacity-5">exit_to_app</span>
                    <span class="nav-link-text ms-1">Barang Keluar</span>
                </a>
            </li>

            {{-- Laporan --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('laporan.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                    href="{{ route('laporan.index') }}">
                    <i class="material-symbols-rounded opacity-5">description</i>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
            </li>

            {{-- Users (Admin only) --}}
            @if ($user->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ route('users.index') }}">
                        <i class="material-symbols-rounded opacity-5">group</i>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>

                {{-- Backup --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('backup.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ route('backup.index') }}">
                        <i class="material-symbols-rounded opacity-5">backup</i>
                        <span class="nav-link-text ms-1">Backup</span>
                    </a>
                </li>

                {{-- Aktivitas --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('log.*') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ route('log.index') }}">
                        <i class="material-symbols-rounded opacity-5">history</i>
                        <span class="nav-link-text ms-1">Aktivitas</span>
                    </a>
                </li>
            @endif

            {{-- Logout --}}
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-start text-dark w-100 ps-3">
                        <i class="material-symbols-rounded opacity-5">logout</i>
                        <span class="nav-link-text ms-1">Logout</span>
                    </button>
                </form>
            </li>

        </ul>
    </div>
</aside>
