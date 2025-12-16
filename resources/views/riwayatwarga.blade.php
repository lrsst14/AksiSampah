@extends('layouts.warga-layout')

@section('content')
<div class="container-lg px-3 pt-4">

    <!-- Judul -->
    <div class="text-center mb-4">
        <h4 class="fw-bold" style="color:#598665;">
            <i class="fa-solid fa-clock-rotate-left me-2"></i>Riwayat Laporan
        </h4>
    </div>

    <!-- Card Riwayat -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom" style="border-color:#e0e0e0 !important;">
            <h6 class="card-title fw-bold mb-0" style="color:#598665;">
                <i class="fa-solid fa-history me-2"></i>Riwayat Laporan Sampah
            </h6>
        </div>
        <div class="card-body p-4">
            @if($laporans->count() > 0)
                @foreach($laporans as $laporan)
                <div class="mb-3 p-3 border rounded">
                    <h6>{{ $laporan->judul }}</h6>
                    <p>{{ $laporan->deskripsi }}</p>
                    <small class="text-muted">Lokasi: {{ $laporan->lokasi }} | Tanggal: {{ $laporan->created_at->format('d M Y') }}</small>
                    @if($laporan->foto)
                    <br><img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto" class="img-fluid mt-2" style="max-width:200px;">
                    @endif
                </div>
                @endforeach
            @else
                <p class="text-muted">Belum ada riwayat laporan.</p>
            @endif
        </div>
    </div>

</div>
@endsection