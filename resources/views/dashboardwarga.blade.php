@extends('layouts.warga-layout')

@section('content')

<div class="container-fluid py-4 dashboard-bg">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h3 class="mb-0" style="font-family:'poppins'; font-weight:700;">Dashboard Warga</h3>
            <small class="text-muted">Ringkasan aktivitas dan laporan sampah Anda</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('warga.laporan') }}" class="btn text-white d-inline-flex align-items-center gap-2 px-4 py-2" style="background:#598665; border-radius:8px">
                <i class="fa-solid fa-plus"></i>
                Buat Laporan
            </a>
        </div>
    </div>

@php
    $user = Auth::user();
    $pendingCount = $user->laporans()->where('status', 'pending')->count();
    $verifiedCount = $user->laporans()->where('status', 'verified')->count();
@endphp

{{-- STATISTIK STATUS --}}
<div class="row text-center mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-3 dashboard-card">
            <a href="{{ route('warga.riwayat') }}" class="text-decoration-none text-dark">
                <span class="text-muted">Menunggu Verifikasi</span>
                <h3 class="text-primary fw-bold">{{ $pendingCount }}</h3>
            </a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-3 dashboard-card">
            <a href="{{ route('warga.riwayat') }}" class="text-decoration-none text-dark">
                <span class="text-muted">Terverifikasi</span>
                <h3 class="text-success fw-bold">{{ $verifiedCount }}</h3>
            </a>
        </div>
    </div>
</div>

{{-- STATISTIK SAMPAH BULANAN --}}
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4">
                {{-- Hapus style inline font-family --}}
                <h5 class="mb-4 fw-bold text-dark">
                    Statistik Sampah Bulanan
                </h5>
                <div class="row g-4">
                    {{-- Grafik Total Sampah (Bulan Ini vs Bulan Lalu) --}}
                    <div class="col-12 col-lg-6">
                        <h6 class="text-muted small mb-2">Total Sampah (Kg)</h6>
                        {{-- Container untuk Grafik --}}
                        <div class="bg-light p-5 border rounded d-flex justify-content-center align-items-center" style="min-height: 200px;">
                            Grafik Placeholder
                        </div>
                        <div class="d-flex justify-content-around mt-2 small fw-bold text-center">
                            <span>Bulan Ini (X gram)</span>
                            <span>Bulan Lalu (Y gram)</span>
                        </div>
                    </div>
                    {{-- Grafik Persentase Jenis Sampah --}}
                    <div class="col-12 col-lg-6">
                        <h6 class="text-muted small mb-2">Persentase Jenis Sampah</h6>
                        <div class="d-flex align-items-center gap-4">
                            {{-- Container untuk Donut Chart --}}
                            <div class="bg-light p-4 border rounded d-flex justify-content-center align-items-center" style="min-height: 200px; width: 50%;">
                                Chart Placeholder
                            </div>
                            {{-- Keterangan --}}
                            <div class="small">
                                <p class="mb-1"><i class="fa fa-circle text-info me-2"></i> Anorganik</p>
                                <p class="mb-1"><i class="fa fa-circle text-success me-2"></i> Organik</p>
                                <p class="mb-1"><i class="fa fa-circle text-warning me-2"></i> Plastik</p>
                                <p class="mb-1"><i class="fa fa-circle text-danger me-2"></i> B3</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    {{-- BARIS 3: JADWAL & POIN --}}
    <div class="row g-4 mb-4">

        {{-- Jadwal Berikutnya (Kiri) --}}
        <div class="col-12 col-lg-6">
            {{-- Hapus inline padding (p-3) di div luar, gunakan padding di card-body --}}
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    {{-- Hapus style inline font-family --}}
                    <h5 class="mb-4 fw-bold text-dark">
                        Jadwal Berikutnya
                    </h5>

                    <div class="mb-4">
                        <p class="mb-1 fw-bold">
                            Pengambilan selanjutnya di lokasi Anda:
                        </p>
                        @php
                            $nextJadwal = \App\Models\Jadwal::where('tanggal', '>=', now()->toDateString())
                                ->orderBy('tanggal')
                                ->orderBy('waktu')
                                ->first();
                            if ($nextJadwal) {
                                $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
                                $bulan = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'];
                                $tanggal = \Carbon\Carbon::parse($nextJadwal->tanggal);
                                $hariNama = $hari[$tanggal->format('l')];
                                $bulanNama = $bulan[$tanggal->format('F')];
                                $tanggalFormat = $hariNama . ', ' . $tanggal->format('d') . ' ' . $bulanNama . ' ' . $tanggal->format('Y');
                            }
                        @endphp
                        @if($nextJadwal)
                            <h4 class="fw-bold text-success mb-1">
                                {{ $tanggalFormat }}
                            </h4>
                            <p class="text-muted">Pukul {{ $nextJadwal->waktu }}</p>
                        @else
                            <h4 class="fw-bold text-muted mb-1">
                                Tidak ada jadwal
                            </h4>
                            <p class="text-muted">Belum ada jadwal pengangkutan</p>
                        @endif
                    </div>

                    <a href="{{ route('warga.jadwal') }}" class="btn btn-outline-success">
                        Lihat Detail Jadwal
                    </a>
                </div>
            </div>
        </div>

        {{-- Total Poin (Kanan) --}}
        <div class="col-12 col-lg-6">
            {{-- Hapus inline padding (p-3) di div luar, gunakan padding di card-body --}}
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    {{-- Hapus style inline font-family --}}
                    <h5 class="mb-3 fw-bold text-dark">
                        Total Poin
                    </h5>

                    <div class="text-center">
                        <h1 class="fw-bold display-4 text-primary mb-3">
                            {{ Auth::user()->poin }} <span class="fs-4 text-muted">pts</span>
                        </h1>
                    </div>

                    <div class="small text-center mt-2">
                        <p class="mb-1">Poin diperoleh dari laporan sampah</p>
                        <p class="fw-bold text-success">
                            10 poin per 100 gram sampah
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    @endsection