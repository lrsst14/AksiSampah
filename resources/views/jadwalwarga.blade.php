@extends('layouts.warga-layout')

@section('content')
<div class="container-lg px-3 pt-4">

    <!-- Judul -->
    <div class="text-center mb-4">
        <h4 class="fw-bold" style="color:#598665;">
            <i class="fa-solid fa-calendar me-2"></i>Jadwal Pengangkutan
        </h4>
    </div>

    <!-- Card Jadwal -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom" style="border-color:#e0e0e0 !important;">
            <h6 class="card-title fw-bold mb-0" style="color:#598665;">
                <i class="fa-solid fa-calendar-check me-2"></i>Jadwal Pengangkutan Sampah
            </h6>
        </div>
        <div class="card-body p-4">
            <p class="text-muted">Jadwal pengangkutan akan ditampilkan di sini.</p>
        </div>
    </div>

</div>
@endsection