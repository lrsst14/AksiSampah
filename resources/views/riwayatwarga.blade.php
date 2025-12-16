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
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead>
                            <tr class="text-muted small" style="text-align: center;">
                                <th style="text-align: center;">ID Laporan</th>
                                <th style="text-align: center;">Tanggal Laporan</th>
                                <th style="text-align: center;">Lokasi</th>
                                <th style="text-align: center;">Judul</th>
                                <th style="text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporans as $laporan)
                            <tr class="border-top">
                                <td data-label="ID Laporan" style="text-align: center;">#{{ $laporan->id }}</td>
                                <td data-label="Tanggal" style="text-align: center;">{{ $laporan->created_at->format('Y-m-d') }}</td>
                                <td data-label="Lokasi" style="text-align: center;">{{ $laporan->lokasi }}</td>
                                <td data-label="Judul" style="text-align: center;">{{ $laporan->judul }}</td>
                                <td data-label="Status" style="text-align: center;">{{ ucfirst($laporan->status) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Belum ada riwayat laporan.</p>
            @endif
        </div>
    </div>

</div>
@endsection