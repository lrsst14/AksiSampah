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

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</head>

<style>
    .dashboard-card {
        transition: all 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
</style>

<body style="background-color: #DDE6D1;">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg shadow-sm fixed-top" style="background-color: #fce2c9;">
        <div class="container-fluid">

            {{-- LOGO --}}
            <img src="{{ asset('img/logo-zoom.png') }}" style="max-height:40px" alt="Logo">

            {{-- TOGGLE --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarWarga">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- MENU --}}
            <div class="collapse navbar-collapse" id="navbarWarga">

                <ul class="navbar-nav mx-auto fw-semibold gap-lg-4 text-center">

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center" href="{{ route('warga.dashboard') }}">
                            <i class="fa fa-house"></i>
                            <span class="d-none d-lg-inline">HOME</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center" href="{{ route('warga.laporan') }}">
                            <i class="fa fa-trash"></i>
                            <span class="d-none d-lg-inline">LAPORAN SAMPAH</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center" href="#">
                            <i class="fa fa-clock-rotate-left"></i>
                            <span class="d-none d-lg-inline">RIWAYAT</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center" href="#">
                            <i class="fa fa-calendar"></i>
                            <span class="d-none d-lg-inline">JADWAL</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 justify-content-center" href="#">
                            <i class="fa fa-graduation-cap"></i>
                            <span class="d-none d-lg-inline">EDUKASI</span>
                        </a>
                    </li>

                </ul>

                {{-- USER --}}
                <div class="d-flex align-items-center gap-2 ms-lg-3 justify-content-center">
                    <img src="https://ui-avatars.com/api/?name=Warga" class="rounded-circle" height="36">
                    <span class="d-none d-lg-inline">Nama Warga</span>
                    <button class="btn btn-outline-dark btn-sm">
                        <i class="fa fa-right-from-bracket"></i>
                    </button>
                </div>

            </div>
        </div>
    </nav>


    {{-- SIDEBAR + CONTENT --}}
    <div style="padding-top:70px; min-height:100vh;">

        {{-- SIDEBAR --}}
        <aside class="sidebar d-flex flex-column align-items-center"
            style="width:70px; position:fixed; left:0; top:70px; height:calc(100vh - 70px); background:#598665;">
            <a href="{{ route('warga.dashboard') }}" class="py-5 text-white">
                <i class="fa fa-home fs-5"></i>
            </a>
            <a href="{{ route('warga.laporan') }}" class="py-5 text-white">
                <i class="fa fa-trash fs-5"></i>
            </a>
            <a href="#" class="py-5 text-white">
                <i class="fa fa-clock-rotate-left fs-5"></i>
            </a>
            <a href="#" class="py-5 text-white">
                <i class="fa fa-calendar fs-5"></i>
            </a>
            <a href="#" class="py-5 text-white">
                <i class="fa fa-graduation-cap fs-5"></i>
            </a>
        </aside>

        {{-- CONTENT --}}
        <main style="margin-left:70px; padding:1.5rem; min-height:calc(100vh - 70px);">
            @yield('content')
        </main>

    </div>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white mt-5 py-5" style="margin-left: 70px;">
        <div class="container">
            <div class="row">
                {{-- Tentang --}}
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Tentang AksiSampah</h6>
                    <p class="small text-light">
                        AksiSampah adalah platform digital untuk memudahkan pelaporan dan penjadwalan pengangkutan sampah komunitas Anda.
                    </p>
                </div>

                {{-- Menu Cepat --}}
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Menu Cepat</h6>
                    <ul class="list-unstyled small">
                        <li><a href="{{ route('warga.dashboard') }}" class="text-decoration-none text-light">Dashboard</a></li>
                        <li><a href="{{ route('warga.laporan') }}" class="text-decoration-none text-light">Buat Laporan</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Jadwal Pengangkutan</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Edukasi Sampah</a></li>
                    </ul>
                </div>

                {{-- Kontak --}}
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Hubungi Kami</h6>
                    <p class="small text-light mb-1">
                        <i class="fa fa-phone me-2"></i>+62 812 3456 7890
                    </p>
                    <p class="small text-light mb-1">
                        <i class="fa fa-envelope me-2"></i>info@aksisampah.id
                    </p>
                    <p class="small text-light">
                        <i class="fa fa-map-marker me-2"></i>Jl. Kebersihan No. 1, Kota
                    </p>
                </div>

                {{-- Social Media --}}
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold mb-3 text-white">Ikuti Kami</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle">
                            <i class="fa fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle">
                            <i class="fa fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle">
                            <i class="fa fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr class="bg-secondary">

            {{-- Copyright --}}
            <div class="row">
                <div class="col-md-6">
                    <p class="small text-light mb-0">
                        &copy; 2025 AksiSampah. Semua hak dilindungi.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="small text-light mb-0">
                        <a href="#" class="text-decoration-none text-light">Kebijakan Privasi</a> |
                        <a href="#" class="text-decoration-none text-light">Syarat Layanan</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>