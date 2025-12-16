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
            @if($jadwals->count() > 0)
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead>
                            <tr class="text-muted small" style="text-align: center;font-family:'poppins';">
                                <th style="text-align: left;">Lokasi</th>
                                <th style="text-align: center;">Tanggal</th>
                                <th style="text-align: center;">Waktu</th>
                                <th style="text-align: center;">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwals as $jadwal)
                            <tr class="border-top">
                                <td style="text-align: left;font-family:'poppins';">{{ $jadwal->lokasi }}</td>
                                <td style="text-align: center;font-family:'poppins';">{{ $jadwal->tanggal->format('d/m/Y') }}</td>
                                <td style="text-align: center;font-family:'poppins';">{{ $jadwal->waktu->format('H:i') }}</td>
                                <td style="text-align: center;font-family:'poppins';">{{ $jadwal->deskripsi ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Belum ada jadwal pengangkutan.</p>
            @endif
        </div>
    </div>

</div>
@endsection