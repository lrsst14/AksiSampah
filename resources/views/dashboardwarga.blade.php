@extends('layouts.warga-layout')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- BUTTON LAPORAN --}}
<div class="mb-4">
    <a href="{{ route('warga.laporan') }}"
        class="btn text-white d-inline-flex align-items-center gap-2 px-4 py-2"
        style="background:#598665; border-radius:8px">
        <i class="fa-solid fa-plus"></i>
        Buat Laporan Sampah
    </a>
</div>

{{-- STATISTIK STATUS --}}
<div class="row text-center mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 dashboard-card">
            <span class="text-muted">Menunggu Verifikasi</span>
            <h3 class="text-warning fw-bold">12</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 dashboard-card">
            <span class="text-muted">Diproses</span>
            <h3 class="text-primary fw-bold">5</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 dashboard-card">
            <span class="text-muted">Selesai</span>
            <h3 class="text-success fw-bold">15</h3>
        </div>
    </div>
</div>

{{-- STATISTIK BULANAN --}}
<div class="card border-0 shadow-sm p-4 mb-4">
    <h6 class="fw-semibold mb-3">Statistik Sampah Bulanan</h6>

    <img src="https://dummyimage.com/900x300/cccccc/000000&text=Grafik+Statistik+Sampah"
        class="img-fluid rounded"
        alt="Grafik Statistik">
</div>

{{-- JADWAL & POIN --}}
<div class="row g-3">

    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-semibold">Jadwal Pengangkutan Berikutnya</h6>
            <p class="mb-1">📍 Lokasi Anda</p>
            <p>🗓 Senin, 18 Desember 2025<br>⏰ 07.00 WIB</p>
            <button class="btn btn-sm text-white"
                style="background:#598665">
                Lihat Detail Jadwal
            </button>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-semibold">Total Poin</h6>
            <h2 class="fw-bold text-success">12.500 pts</h2>
            <small class="text-muted">Berlaku hingga 31/12/2025</small>

            <div class="mt-3">
                <img src="https://dummyimage.com/300x120/e0e0e0/000000&text=Reward"
                    class="img-fluid rounded">
            </div>
        </div>
    </div>

</div>

@endsection