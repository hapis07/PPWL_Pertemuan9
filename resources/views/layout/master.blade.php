<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Mazer Dashboard')</title>

    <link rel="stylesheet"
          href="{{ asset('mazer/assets/compiled/css/app.css') }}">

    @stack('styles')
</head>

<body>
<div id="app">

    {{-- SIDEBAR --}}
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">

            <div class="sidebar-header position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{ route('buku.index') }}">MAZER</a>
                    </div>

                    <div class="sidebar-toggler x">
                        <a href="#" class="sidebar-hide d-xl-none d-block">
                            <i class="bi bi-x"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="sidebar-menu">
                <ul class="menu">

                    <li class="sidebar-title">Menu Utama</li>

                    <li class="sidebar-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                        <a href="{{ route('buku.index') }}"
                           class="sidebar-link">
                            <i class="bi bi-book"></i>
                            <span>Data Buku</span>
                        </a>
                    </li>

                    @auth
                        <li class="sidebar-title">Akun</li>

                        <li class="sidebar-item">
                            <form action="{{ route('logout') }}"
                                  method="POST"
                                  class="px-4">
                                @csrf

                                <button type="submit"
                                        class="btn btn-link p-0 text-decoration-none">
                                    <i class="bi bi-box-arrow-right"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="sidebar-item">
                            <a href="{{ route('login') }}"
                               class="sidebar-link">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Login</span>
                            </a>
                        </li>
                    @endauth

                </ul>
            </div>

        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div id="main">

        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>@yield('heading', 'Dashboard')</h3>
        </div>

        <div class="page-content">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Tutup"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali data yang dimasukkan.</strong>

                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>{{ date('Y') }} &copy; Aplikasi Data Buku</p>
                </div>
            </div>
        </footer>

    </div>
</div>

<script src="{{ asset('mazer/assets/compiled/js/app.js') }}"></script>

@stack('scripts')
</body>
</html>