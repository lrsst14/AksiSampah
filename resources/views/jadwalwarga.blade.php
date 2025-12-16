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
            @php
            // Group jadwal by tanggal
            $jadwalByTanggal = $jadwals->groupBy(function($item) {
            return $item->tanggal->format('Y-m-d');
            })->sortKeys();
            @endphp

            @foreach($jadwalByTanggal as $tanggalKey => $jadwalGroup)
            @php
            $tanggalObj = \Carbon\Carbon::parse($tanggalKey);
            $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][$tanggalObj->dayOfWeek];
            @endphp

            <!-- Header Tanggal -->
            <div class="mb-3 p-3" style="background-color: #f5f5f5; border-radius: 8px;">
                <h6 class="mb-0 fw-bold" style="font-family:'poppins'; color:#333;">
                    <i class="fa-solid fa-calendar me-2" style="color:#598665;"></i>
                    {{ $hari }}, {{ $tanggalObj->isoFormat('D MMMM Y') }}
                </h6>
                <small style="color:#888;">Lihat jadwal pengangkutan sampah untuk area anda</small>
            </div>

            <!-- Jadwal Items -->
            <div class="mb-4 p-3 border rounded" style="background-color: #fafafa; border-color:#e0e0e0 !important;">
                @foreach($jadwalGroup as $jadwal)
                <div class="mb-3 pb-3 d-flex justify-content-between align-items-start" @if(!$loop->last) style="border-bottom: 1px solid #e0e0e0;" @endif>
                    <div style="flex-grow: 1;">
                        <!-- Lokasi -->
                        <div class="d-flex align-items-start mb-2">
                            <i class="fa-solid fa-location-dot me-2" style="color:#598665; margin-top: 2px;"></i>
                            <span style="font-family:'poppins'; color:#333;">{{ $jadwal->lokasi }}</span>
                        </div>

                        <!-- Waktu -->
                        <div class="d-flex align-items-center mb-2 ms-1">
                            <i class="fa-solid fa-clock me-2" style="color:#598665;"></i>
                            <span style="font-family:'poppins'; color:#666;">{{ $jadwal->waktu->format('H:i') }}</span>
                        </div>

                        <!-- Deskripsi -->
                        <div class="d-flex align-items-center ms-1">
                            <i class="fa-solid fa-file-alt me-2" style="color:#598665;"></i>
                            <span style="font-family:'poppins'; color:#888;">{{ $jadwal->deskripsi ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Terjadwal Badge -->
                    <span style="background-color: transparent; border: 2px solid #598665; color: #598665; border-radius: 20px; font-weight: 600; font-size: 0.75rem; padding: 6px 14px; font-family:'poppins'; white-space: nowrap; margin-left: 10px;">
                        Terjadwal
                    </span>
                </div>
                @endforeach
            </div>
            @endforeach
            @else
            <p class="text-muted">Belum ada jadwal pengangkutan.</p>
            @endif
        </div>
    </div>

</div>
@endsection