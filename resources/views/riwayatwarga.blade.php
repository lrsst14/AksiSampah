@extends('layouts.warga-layout')

@section('content')

<div class="container-fluid py-4 dashboard-bg">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h3 class="mb-0" style="font-family: 'poppins'; font-weight:700;">Riwayat Laporan</h3>
            <small class="text-muted">Daftar lengkap laporan yang Anda buat</small>
        </div>
    </div>

    @if(session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
    @endif
        <div class="row g-4">
            @foreach($laporans as $laporan)
            <div class="col-12">
                <div class="card shadow-sm border-0 p-3">
                    <div class="card-body">
                        
                        {{-- Header Laporan (Nama/Judul & Status) --}}
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-bold mb-1 text-dark">{{ $laporan->judul ?? 'Laporan Sampah' }}</h5>
                                <span class="badge bg-secondary">{{ $laporan->jenis_sampah ?? 'Sampah Rumah Tangga' }}</span>
                            </div>
                            
                            {{-- Badge Status --}}
                            @php
                                $statusText = $laporan->status == 'pending' ? 'Diproses' : ($laporan->status == 'verified' ? 'Selesai' : ucfirst($laporan->status));
                                $statusClass = $laporan->status == 'pending' ? 'bg-warning text-dark' : ($laporan->status == 'verified' ? 'bg-success' : 'bg-secondary');
                            @endphp
                            <span class="badge {{ $statusClass }} text-uppercase fw-bold p-2">
                                {{ $statusText }}
                            </span>
                        </div>

                        {{-- Detail Laporan --}}
                        <div class="small text-muted mb-3">
                            <p class="mb-1"><i class="fa-solid fa-location-dot me-2"></i> {{ $laporan->lokasi ?? 'Alamat tidak tersedia' }}</p>
                            <p class="mb-1"><i class="fa-solid fa-weight-hanging me-2"></i> {{ $laporan->gram ?? 0 }} gram</p>
                            <p class="mb-2">{{ $laporan->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                        </div>

                        {{-- Footer Laporan (Tanggal) --}}
                        <div class="d-flex gap-4 small text-dark border-top pt-2">
                            <p class="mb-0"><i class="fa-solid fa-calendar-day me-1"></i> Dilaporkan: **{{ $laporan->created_at->format('d/m/Y') }}**</p>
                            
                            @if($laporan->tanggal_ambil)
                            <p class="mb-0"><i class="fa-solid fa-calendar-check me-1"></i> Dijadwalkan: **{{ \Carbon\Carbon::parse($laporan->tanggal_ambil)->format('d/m/Y') }}**</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    {{-- Jika Laporan Kosong --}}
    @else
        <div class="card shadow-sm border-0 p-4 text-center">
            <p class="text-muted mb-0">Belum ada riwayat laporan yang dibuat oleh Anda.</p>
        </div>
    @endif

</div>
@endsection