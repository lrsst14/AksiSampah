<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>AksiSampah - Warga</title>
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
        --sidebar-gap: 16px;
        /* extra space between sidebar and content */
        --header-height: 70px;
        /* navbar height */
        --small-tabs-height: 70px;
        /* small tab nav height on mobile */
    }

    .navbar {
        min-height: var(--header-height);
    }

    .navbar {
        z-index: 1045;
    }

    .dashboard-card {
        transition: all 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .warga-tabs {
        background-color: white;
        padding: 12px 0;
        margin-top: var(--header-height);
    }

    /* Navbar color and link styles */
    .navbar {
        background-color: whitesmoke;
    }

    .navbar .nav-link,
    .navbar .nav-link i,
    .navbar .navbar-brand {
        color: #111;
    }

    .navbar .nav-link.active {
        color: #111;
        font-weight: 700;
    }

    .navbar .nav-link:hover {
        color: black;
    }

    .navbar .navbar-toggler {
        border-color: rgba(0, 0, 0, 0.08);
    }

    /* Make the hamburger (navbar-toggler-icon) black on white header */
    .navbar .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='%23000' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }

    /* User avatar and name styles in navbar */
    .navbar .user-name {
        color: #111;
        font-weight: 600;
    }

    /* Make avatar circular and remove border/shadow */
    .navbar .user-avatar {
        border: none;
        box-shadow: none;
        border-radius: 50%;
        height: 36px;
        width: 36px;
        object-fit: cover;
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
        padding-top: calc(var(--header-height) + 20px);
        /* safe fallback */
    }

    @media (min-width: 992px) {

        /* On desktop: only main navbar visible */
        .warga-tabs {
            display: none;
        }

        .sidebar {
            top: var(--header-height);
            height: calc(100vh - var(--header-height));
        }

        .main-content {
            margin-left: calc(var(--sidebar-width) + var(--sidebar-gap));
            padding: 1.5rem;
            padding-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
        }
    }

    @media (max-width: 991.98px) {

        /* On smaller screens: hide the small tab nav and use the navbar hamburger instead */
        .warga-tabs {
            display: none;
        }

        /* sidebar should sit below header (or header+tabs when tabs visible) */
        .sidebar {
            top: calc(var(--header-height) + var(--small-tabs-height));
            height: calc(100vh - (var(--header-height) + var(--small-tabs-height)));
        }

        .main-content {
            margin-left: calc(var(--sidebar-width) + var(--sidebar-gap));
            padding: 1.5rem;
            padding-top: calc(var(--header-height) + var(--small-tabs-height));
            min-height: calc(100vh - (var(--header-height) + var(--small-tabs-height)));
        }
    }

    /* Make collapsed navbar overlay instead of pushing content down */
    @media (max-width: 991.98px) {
        .navbar .collapse {
            position: absolute;
            top: var(--header-height);
            left: 0;
            width: 100%;
            z-index: 1040;
            background: whitesmoke;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .navbar .collapse .nav-link {
            padding: 0.75rem 1rem;
        }
    }

    @media (max-width: 575.98px) {
        footer {
            margin-left: 0 !important;
            width: 100% !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        /* Hide the fixed sidebar on small screens so it doesn't cover content */
        .sidebar {
            display: none !important;
        }

        /* Ensure main content occupies full width on mobile */
        .main-content {
            margin-left: 0 !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        /* Stack footer columns and improve tap targets on small screens */
        footer .container .row {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        footer .container .col-md-3 {
            width: 100%;
            padding-left: 0;
            padding-right: 0;
        }

        footer .container .col-md-3 h6 {
            margin-bottom: 0.5rem;
        }

        footer .list-unstyled.small li a {
            display: inline-block;
            padding: 6px 0;
        }

        footer .d-flex.gap-2 a.btn {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        footer .text-md-end {
            text-align: left !important;
        }
    }

    /* Footer social buttons: thin bordered circular icons (transparent fill) */
    footer .d-flex.gap-2 a.btn {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: transparent;
        color: #111;
        border: 1px solid rgba(0, 0, 0, 0.12);
        box-shadow: none;
    }

    footer .d-flex.gap-2 a.btn:hover {
        transform: translateY(-1px);
        background: rgba(0, 0, 0, 0.04);
    }
</style>

<body style="background-color: #DDE6D1;">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top">
        <div class="container-fluid">

            {{-- LOGO --}}
            <img src="{{ asset('img/logo-zoom.png') }}" style="max-height:40px" alt="Logo">
            {{-- Compact user block for small screens (kept outside collapse so it stays on one line) --}}
            <div class="d-flex align-items-center gap-2 ms-auto d-lg-none">
                <img src="{{ asset('img/avatar.png') }}" height="36" alt="Avatar" class="user-avatar">
                <span class="d-none d-sm-inline user-name">{{ Auth::user()->name ?? 'Warga' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline ms-2">
                    @csrf
                    <button type="submit" aria-label="Logout" title="Logout" class="p-0 text-dark text-decoration-none" style="border:none; background:transparent;">
                        <i class="fa fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>

            {{-- TOGGLE --}}
            <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarWarga" aria-controls="navbarWarga" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- MENU --}}
            <div class="collapse navbar-collapse" id="navbarWarga">
                <ul class="navbar-nav mx-auto fw-semibold gap-lg-4 text-center">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center {{ request()->routeIs('warga.dashboard') ? 'active' : '' }}" href="{{ route('warga.dashboard') }}">
                            <i class="fa fa-house"></i>
                            <span class="d-none d-lg-inline">HOME</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center {{ request()->routeIs('warga.laporan') ? 'active' : '' }}" id="nav-laporan" href="{{ route('warga.laporan') }}">
                            <i class="fa fa-trash"></i>
                            <span class="d-none d-lg-inline">LAPORAN SAMPAH</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center {{ request()->routeIs('warga.riwayat') ? 'active' : '' }}" id="nav-riwayat" href="{{ route('warga.riwayat') }}">
                            <i class="fa fa-history"></i>
                            <span class="d-none d-lg-inline">RIWAYAT</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center {{ request()->routeIs('warga.jadwal') ? 'active' : '' }}" id="nav-jadwal" href="{{ route('warga.jadwal') }}">
                            <i class="fa fa-calendar"></i>
                            <span class="d-none d-lg-inline">JADWAL PENGANGKUTAN</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center {{ request()->routeIs('warga.edukasi') ? 'active' : '' }}" id="nav-edukasi" href="{{ route('warga.edukasi') }}">
                            <i class="fa fa-graduation-cap"></i>
                            <span class="d-none d-lg-inline">EDUKASI</span>
                        </a>
                    </li>
                </ul>

                {{-- USER --}}
                <div class="d-flex align-items-center gap-2 ms-lg-3 justify-content-center d-none d-lg-flex">
                    <img src="{{ asset('img/avatar.png') }}" height="36" alt="Avatar" class="user-avatar">
                    <span class="d-none d-lg-inline user-name">{{ Auth::user()->name ?? 'Warga' }}</span>

                    {{-- Logout using a POST form to match Laravel's logout route --}}
                    <form method="POST" action="{{ route('logout') }}" class="d-inline ms-2">
                        @csrf
                        <button type="submit" aria-label="Logout" title="Logout" class="p-0 text-dark text-decoration-none" style="border:none; background:transparent;">
                            <i class="fa fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- SMALL TAB NAV (as in dashboard) --}}
    <div class="warga-tabs">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-12">
                    <ul class="nav nav-underline justify-content-center" id="wargaTabs">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('warga.dashboard') ? 'active' : '' }}" id="home-tab" href="{{ route('warga.dashboard') }}" style="color: black; font-family:'poppins'; font-weight: bold;">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('warga.laporan') ? 'active' : '' }}" id="laporan-tab" href="{{ route('warga.laporan') }}" style="color: black; font-family:'poppins'; font-weight: bold;">LAPORAN SAMPAH</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('warga.riwayat') ? 'active' : '' }}" id="riwayat-tab" href="{{ route('warga.riwayat') }}" style="color: black; font-family:'poppins'; font-weight: bold;">RIWAYAT LAPORAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('warga.jadwal') ? 'active' : '' }}" id="jadwal-tab" href="{{ route('warga.jadwal') }}" style="color: black;font-family:'poppins'; font-weight: bold;">JADWAL PENGANGKUTAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('warga.edukasi') ? 'active' : '' }}" id="edukasi-tab" href="{{ route('warga.edukasi') }}" style="color: black;font-family:'poppins'; font-weight: bold;">EDUKASI</a>
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
            <a href="{{ route('warga.dashboard') }}" class="py-3 text-white">
                <i class="fa fa-house fs-5"></i>
            </a>
            <a href="{{ route('warga.laporan') }}" class="py-3 text-white">
                <i class="fa fa-trash fs-5"></i>
            </a>
            <a href="{{ route('warga.riwayat') }}" class="py-3 text-white">
                <i class="fa fa-history fs-5"></i>
            </a>
            <a href="{{ route('warga.jadwal') }}" class="py-3 text-white">
                <i class="fa fa-calendar fs-5"></i>
            </a>
            <a href="{{ route('warga.edukasi') }}" class="py-3 text-white">
                <i class="fa fa-graduation-cap fs-5"></i>
            </a>
        </aside>

        {{-- CONTENT --}}
        <main class="main-content">
            @yield('content')
        </main>

    </div>

    {{-- FOOTER --}}
    <footer class="text-black mt-5 py-5" style="background:whitesmoke; margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); padding-left: var(--sidebar-gap);">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-black">Tentang AksiSampah</h6>
                    <p class="small text-black">AksiSampah adalah platform digital untuk memudahkan pelaporan dan penjadwalan pengangkutan sampah komunitas Anda.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-black">Menu Cepat</h6>
                    <ul class="list-unstyled small">
                        <li><a href="{{ route('warga.dashboard') }}" class="text-decoration-none text-black">Dashboard-Warga</a></li>
                        <li><a href="{{ route('warga.laporan') }}" class="text-decoration-none text-black">Laporan Sampah</a></li>
                        <li><a href="{{ route('warga.riwayat') }}" class="text-decoration-none text-black">Riwayat Laporan</a></li>
                        <li><a href="{{ route('warga.jadwal') }}" class="text-decoration-none text-black">Jadwal Pengangkutan</a></li>
                        <li><a href="{{ route('warga.edukasi') }}" class="text-decoration-none text-black">Edukasi</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-black">Hubungi Kami</h6>
                    <p class="small text-black mb-1"><i class="fa fa-phone me-2"></i>+62 812 3456 7890</p>
                    <p class="small text-black mb-1"><i class="fa fa-envelope me-2"></i>info@aksisampah.id</p>
                    <p class="small text-black"><i class="fa fa-map-marker me-2"></i>Jl. Kebersihan No. 1, Kota</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-black">Ikuti Kami</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm btn-outline-black rounded-circle"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-black rounded-circle"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-black rounded-circle"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-black rounded-circle"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="row">
                <div class="col-md-6">
                    <p class="small text-black mb-0">&copy; 2025 AksiSampah. Semua hak dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="small text-black mb-0"><a href="#" class="text-decoration-none text-black">Kebijakan Privasi</a> | <a href="#" class="text-decoration-none text-black">Syarat Layanan</a></p>
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
            const tabs = document.querySelector('.warga-tabs');
            const headerHeight = header ? Math.ceil(header.getBoundingClientRect().height) : 70;
            root.style.setProperty('--header-height', headerHeight + 'px');

            let tabsHeight = 0;
            if (tabs && window.getComputedStyle(tabs).display !== 'none') {
                tabsHeight = Math.ceil(tabs.getBoundingClientRect().height);
            }
            root.style.setProperty('--small-tabs-height', tabsHeight + 'px');
        }

        document.addEventListener('DOMContentLoaded', function() {
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

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>