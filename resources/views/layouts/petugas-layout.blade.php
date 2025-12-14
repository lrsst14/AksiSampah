<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>AksiSampah - Petugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    @stack('styles')
</head>

<style>
    :root {
        --sidebar-width: 70px;
        --sidebar-gap: 16px; /* extra space between sidebar and content */
        --header-height: 70px; /* navbar height */
        --small-tabs-height: 70px; /* small tab nav height on mobile */
    }

    .navbar { min-height: var(--header-height); }
    .navbar { z-index: 1045; }

    .dashboard-card {
        transition: all 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .petugas-tabs {
        background-color: #fce2c9;
        padding: 12px 0;
        margin-top: var(--header-height);
    }

    /* Adjust sidebar / main top offsets depending on whether small tabs are visible */
    .sidebar {
        position: fixed;
        left: 0;
        width: var(--sidebar-width);
        background: #598665;
        top: var(--header-height);
        height: calc(100vh - var(--header-height));
        z-index: 1030;
    }

    /* Main content container: account for fixed navbar and small tabs so headings are not hidden */
    .main-content {
        margin-left: calc(var(--sidebar-width) + var(--sidebar-gap));
        padding: 1.5rem;
        padding-top: calc(var(--header-height) + 20px); /* safe fallback */
    }

    @media (min-width: 992px) {
        /* On desktop: only main navbar visible */
        .petugas-tabs { display: none; }
        .sidebar { top: var(--header-height); height: calc(100vh - var(--header-height)); }
        .main-content { margin-left: calc(var(--sidebar-width) + var(--sidebar-gap)); padding: 1.5rem; padding-top: var(--header-height); min-height: calc(100vh - var(--header-height)); }
    }

    @media (max-width: 991.98px) {
        /* On smaller screens: hide the small tab nav and use the navbar hamburger instead */
        .petugas-tabs { display: none; }
        /* sidebar should sit below header (or header+tabs when tabs visible) */
        .sidebar { top: calc(var(--header-height) + var(--small-tabs-height)); height: calc(100vh - (var(--header-height) + var(--small-tabs-height))); }
        .main-content { margin-left: calc(var(--sidebar-width) + var(--sidebar-gap)); padding: 1.5rem; padding-top: calc(var(--header-height) + var(--small-tabs-height)); min-height: calc(100vh - (var(--header-height) + var(--small-tabs-height))); }
    }

    /* Make collapsed navbar overlay instead of pushing content down */
    @media (max-width: 991.98px) {
        .navbar .collapse {
            position: absolute;
            top: var(--header-height);
            left: 0;
            width: 100%;
            z-index: 1040;
            background: #fce2c9;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .navbar .collapse .nav-link { padding: 0.75rem 1rem; }
    }

    @media (max-width: 575.98px) {
        footer { margin-left: 0 !important; width: 100% !important; padding-left: 1rem !important; padding-right: 1rem !important; }
    }

</style>

<body style="background-color: #DDE6D1;">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg shadow-sm fixed-top" style="background-color: #fce2c9;">
        <div class="container-fluid">

            {{-- LOGO --}}
            <img src="{{ asset('img/logo-zoom.png') }}" style="max-height:40px" alt="Logo">

            {{-- TOGGLE --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPetugas">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- MENU --}}
            <div class="collapse navbar-collapse" id="navbarPetugas">
                <ul class="navbar-nav mx-auto fw-semibold gap-lg-4 text-center">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" href="{{ route('petugas.dashboard') }}">
                            <i class="fa fa-house"></i>
                            <span class="d-none d-lg-inline">HOME</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center {{ request()->routeIs('petugas.daftar') ? 'active' : '' }}" id="nav-daftar" href="{{ route('petugas.daftar') }}">
                            <i class="fa fa-list"></i>
                            <span class="d-none d-lg-inline">DAFTAR LAPORAN</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center {{ request()->routeIs('petugas.jadwal') ? 'active' : '' }}" id="nav-jadwal" href="{{ route('petugas.jadwal') }}">
                            <i class="fa fa-calendar"></i>
                            <span class="d-none d-lg-inline">PENGATURAN JADWAL PENGANGKUTAN</span>
                        </a>
                    </li>
                </ul>

                {{-- USER --}}
                <div class="d-flex align-items-center gap-2 ms-lg-3 justify-content-center">
                    <img src="https://ui-avatars.com/api/?name=Petugas" class="rounded-circle" height="36">
                    <span class="d-none d-lg-inline">Petugas</span>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark btn-sm ms-2">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm ms-2">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- SMALL TAB NAV (as in dashboard) --}}
    <div class="petugas-tabs">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-12">
                    <ul class="nav nav-underline justify-content-center" id="petugasTabs">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" id="home-tab" href="{{ route('petugas.dashboard') }}" style="color: black; font-family:'poppins'; font-weight: bold;">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('petugas.daftar') ? 'active' : '' }}" id="daftar-tab" href="{{ route('petugas.daftar') }}" style="color: black; font-family:'poppins'; font-weight: bold;">DAFTAR LAPORAN MASUK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('petugas.jadwal') ? 'active' : '' }}" id="jadwal-tab" href="{{ route('petugas.jadwal') }}" style="color: black;font-family:'poppins'; font-weight: bold;">PENGATURAN JADWAL PENGANGKUTAN</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{-- SIDEBAR + CONTENT --}}
    <div style="min-height:100vh;">
        {{-- SIDEBAR --}}
        <aside class="sidebar d-flex flex-column align-items-center" style="position:fixed; left:0; background:#598665;">
            <a href="{{ route('petugas.dashboard') }}" class="py-3 text-white">
                <i class="fa fa-house fs-5"></i>
            </a>
            <a href="{{ route('petugas.daftar') }}" class="py-3 text-white">
                <i class="fa fa-list fs-5"></i>
            </a>
            <a href="{{ route('petugas.jadwal') }}" class="py-3 text-white">
                <i class="fa fa-calendar fs-5"></i>
            </a>
        </aside>

        {{-- CONTENT --}}
        <main class="main-content">
            @yield('content')
        </main>

    </div>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white mt-5 py-5" style="margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); padding-left: var(--sidebar-gap);">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Tentang AksiSampah</h6>
                    <p class="small text-light">AksiSampah adalah platform digital untuk memudahkan pelaporan dan penjadwalan pengangkutan sampah komunitas Anda.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Menu Cepat</h6>
                    <ul class="list-unstyled small">
                        <li><a href="{{ route('petugas.dashboard') }}" class="text-decoration-none text-light">Dashboard-Petugas</a></li>
                        <li><a href="{{ route('petugas.daftar') }}" class="text-decoration-none text-light">Daftar Laporan Masuk</a></li>
                        <li><a href="{{ route('petugas.jadwal') }}" class="text-decoration-none text-light">Jadwal Pengangkutan</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Hubungi Kami</h6>
                    <p class="small text-light mb-1"><i class="fa fa-phone me-2"></i>+62 812 3456 7890</p>
                    <p class="small text-light mb-1"><i class="fa fa-envelope me-2"></i>info@aksisampah.id</p>
                    <p class="small text-light"><i class="fa fa-map-marker me-2"></i>Jl. Kebersihan No. 1, Kota</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Ikuti Kami</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="row">
                <div class="col-md-6">
                    <p class="small text-light mb-0">&copy; 2025 AksiSampah. Semua hak dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="small text-light mb-0"><a href="#" class="text-decoration-none text-light">Kebijakan Privasi</a> | <a href="#" class="text-decoration-none text-light">Syarat Layanan</a></p>
                </div>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sync CSS variables for header and small tabs so sidebar can 'nempel' tepat dibawah header
        function syncHeaderAndTabs() {
            const root = document.documentElement;
            const header = document.querySelector('.navbar');
            const tabs = document.querySelector('.petugas-tabs');
            const headerHeight = header ? Math.ceil(header.getBoundingClientRect().height) : 70;
            root.style.setProperty('--header-height', headerHeight + 'px');

            let tabsHeight = 0;
            if (tabs && window.getComputedStyle(tabs).display !== 'none') {
                tabsHeight = Math.ceil(tabs.getBoundingClientRect().height);
            }
            root.style.setProperty('--small-tabs-height', tabsHeight + 'px');
        }

        document.addEventListener('DOMContentLoaded', function(){
            syncHeaderAndTabs();
            window.addEventListener('resize', syncHeaderAndTabs);

            // Listen for bootstrap collapse events to re-sync heights after menu open/close
            const collapses = document.querySelectorAll('.navbar .collapse');
            collapses.forEach(c => {
                c.addEventListener('shown.bs.collapse', () => setTimeout(syncHeaderAndTabs, 50));
                c.addEventListener('hidden.bs.collapse', () => setTimeout(syncHeaderAndTabs, 50));
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
