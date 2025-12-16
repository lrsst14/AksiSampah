@extends('layouts.petugas-layout')

@section('content')

<style>
@media (max-width: 767.98px) {
    .jadwal-header { flex-direction: column !important; align-items: flex-start !important; gap: .75rem !important; }
    .jadwal-header .ms-auto { width: 100%; display:flex; gap:.5rem; }
    .jadwal-header .ms-auto .btn { flex:1 1 auto; }

    /* Stack the ringkasan card: text first, chart centered underneath */
    .ringkasan-row { flex-direction: column !important; align-items: center !important; text-align: center; }
    .ringkasan-row .flex-grow-1 { width: 100%; }
    .ringkasan-widget { width: 140px; height: 140px; margin-top: .75rem; }
}
@media (max-width: 480px) {
    .ringkasan-row { gap: .75rem; }
    .ringkasan-row h2 { font-size: 1.6rem; }
    .ringkasan-row small { font-size: .9rem; }
    #ringkasanBadges { display:flex; gap:.4rem; justify-content:center; flex-wrap:wrap; }
    .ringkasan-widget { width: min(140px, 36vw); }
    .ringkasan-widget canvas { display:block; width:100% !important; height:auto !important; }
    #ringkasanCenter strong { font-size: clamp(14px, 4vw, 20px); }
    .progress { max-width: 90%; margin: .5rem auto; }
}
.ringkasan-row .flex-grow-1 { min-width: 0; }

@media (max-width: 360px) {
    #ringkasanCenter strong { font-size: 14px; }
}

.ringkasan-widget { width: min(160px, 30vw); max-width:160px; aspect-ratio:1/1; position: relative; display:flex; align-items:center; justify-content:center; }
.ringkasan-widget canvas { width: 100% !important; height: 100% !important; display:block; }

/* Show center total and adapt its placement responsively */
#ringkasanCenter { display: block; pointer-events:none; }
@media (min-width: 768px) {
    #ringkasanCenter { position:absolute; top:50%; left:50%; transform: translate(-50%,-50%); }
}
@media (max-width:575.98px) {
    /* On small screens, place total below the chart as a static element */
    #ringkasanCenter { position: static; transform: none; margin-top: .5rem; text-align:center; }
    #ringkasanCenter strong { font-size: 18px; display:block; }
    #ringkasanCenter .small { display:block; color:#6c757d; }
    .ringkasan-widget { display:flex; flex-direction:column; align-items:center; }
    .ringkasan-widget canvas { width: min(160px, 40vw) !important; height: auto !important; }
    /* Make badges easier to tap on mobile and wrap nicely */
    #ringkasanBadges { display:flex; gap:.5rem; justify-content:center; flex-wrap:wrap; }
    #ringkasanBadges .badge { padding:.5rem .6rem; font-size:.85rem; }
    /* Ensure progress bar is full width */
    .progress { max-width: 100%; }
}

    @media (max-width:575.98px) {
        /* compact spacing and font sizes */
        .container-fluid.py-4 { padding-left: 1rem; padding-right: 1rem; }
        h3.mb-0 { font-size: 1.25rem; }
        .card { padding: .85rem; }

        /* Filters: stack and full-width on mobile */
        .filters-row { display:flex; gap:0.5rem; flex-wrap:wrap; }
        .filters-row .dropdown, .filters-row .input-group { flex:1 1 100%; }
        .filters-row .dropdown .btn, .filters-row .input-group .btn { width:100%; }

        /* Chart height reduction for mobile */
        .chart-container { height: 200px !important; }

        /* Tables -> stacked cards */
        .table-responsive table thead { display: none; }
        .table-responsive table tbody tr { display: block; border: 1px solid #e9ecef; border-radius: 8px; margin-bottom: 12px; padding: 8px; background: #fff; }
        .table-responsive table tbody td { display: flex; justify-content: space-between; padding: 6px 8px; }
        .table-responsive table tbody td[data-label]::before { content: attr(data-label) ': '; font-weight: 600; color: #6c757d; margin-right: 6px; }
        .table-responsive table tbody td.action-center { justify-content: flex-end; }
        .btn.detail-btn { width: 100%; }

        /* Ringkasan: center badges and tighten spacing */
        #ringkasanBadges { justify-content: center; gap: .5rem; }
        .ringkasan-widget { margin-top: .5rem; }
/* Top action button full-width on mobile */
        .d-flex.gap-2 > a.btn { width: 100%; display:flex; align-items:center; justify-content:center; }
    }

    /* Jadwal compact styling to match sample */
    .jadwal-card-compact .fw-bold.text-success { color: #2e8a50; font-size:1.05rem; }
    .jadwal-card-compact .small.text-muted { margin-bottom:0.4rem; }
    .jadwal-card-compact .btn-outline-success { border-color:#28a745; color:#28a745; }
    @media (max-width:575.98px) {
        .jadwal-card-compact { text-align:center; }
        .jadwal-card-compact .d-flex { justify-content:center; flex-wrap:wrap; gap:.5rem; }
    }
</style>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-circle-check me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

@endif

<div class="container-fluid py-4 dashboard-bg">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h3 class="mb-0" style="font-family:'poppins'; font-weight:700;">Dashboard Petugas</h3>
            <small class="text-muted">Ringkasan laporan, jadwal, dan statistik</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('petugas.jadwal') }}" class="btn text-white d-inline-flex align-items-center gap-2 px-4 py-2" style="background:#598665; border-radius:8px">
                <i class="fa-solid fa-list"></i>
                Buat Jadwal Pengangkutan
            </a>
        </div>
    </div>

{{-- STATISTIK STATUS --}}
<div class="row text-center mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-3 dashboard-card">
            <span class="text-muted">Menunggu Verifikasi</span>
            <h3 class="text-warning fw-bold">10</h3>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-3 dashboard-card">
            <span class="text-muted">Terverifikasi</span>
            <h3 class="text-success fw-bold">7</h3>
        </div>
    </div>
</div>

{{-- STATISTIK BULANAN --}}
<div class="card border-0 shadow-sm p-4 mb-4">
    <h6 class="fw-semibold mb-3">Statistik Laporan Bulanan</h6>

    <div class="chart-container" style="height:320px;">
        <canvas id="laporanChart" style="max-height:320px; width:100%;"></canvas>
    </div>
    <div class="mt-2 small text-muted">Grafik menunjukkan jumlah laporan per bulan.</div>
</div>

{{-- JADWAL & RINGKASAN --}}
<div class="row g-3">

    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 h-100 jadwal-card-compact" id="jadwalCard" data-date="2025-12-20" data-location="Area 12" data-time="09:00">
            <h6 class="fw-semibold">Jadwal Pengangkutan Berikutnya</h6>

            <p class="small text-muted mb-1">Pengambilan selanjutnya di lokasi Anda:</p>

            <div class="mb-3">
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
                    <div class="fw-bold text-success" id="jadwalDate">{{ $tanggalFormat }}</div>
                    <div class="text-muted small" id="jadwalTime">Pukul {{ $nextJadwal->waktu }}</div>
                @else
                    <div class="fw-bold text-muted" id="jadwalDate">Tidak ada jadwal</div>
                    <div class="text-muted small" id="jadwalTime">Belum ada jadwal pengangkutan</div>
                @endif
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('petugas.jadwal') }}" class="btn btn-sm text-white d-inline-flex align-items-center gap-2" style="background:#598665; border-radius:6px">
                    <i class="fa-solid fa-list me-1"></i> Kelola Jadwal
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-semibold">Ringkasan Laporan Hari Ini</h6>

                <div class="d-flex align-items-center gap-3 ringkasan-row">
                <div class="flex-grow-1">
                    <small class="text-muted">Periode: Hari ini &middot; Terakhir diperbarui {{ now()->format('d M Y H:i') }}</small>
<div class="d-flex gap-2 mt-3" id="ringkasanBadges">
                        <span class="badge bg-warning text-dark" id="badge-menunggu">Menunggu: 10</span>
                        <span class="badge bg-success" id="badge-terverifikasi">Terverifikasi: 7</span>
                    </div>  

                    <div class="mt-3">
                        <div class="progress" style="height:10px; background:#e9f3ec; border-radius:6px; overflow:hidden;">
                            <div class="progress-bar" role="progressbar" id="ringkasanProgress" style="width:35%; background:#3f8a63;"></div>
                        </div>
                        <small class="text-muted" id="ringkasanProgressText">35% laporan selesai hari ini</small> 
                    </div>
                </div>

                <div class="ringkasan-widget">
                    <canvas id="ringkasanChart"></canvas>
                    <div class="position-absolute top-50 start-50 translate-middle text-center text-dark" id="ringkasanCenter" role="status" aria-live="polite" style="pointer-events:none;">
                        <strong id="ringkasanTotal" style="font-size:18px;">34</strong>
                        <div class="small text-muted">Total</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>



@push('scripts')

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function(){
    // Monthly sample data (replace with real data later)
    const labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
    const data = [12, 19, 8, 14, 22, 18, 24, 16, 9, 12, 20, 15];

    const ctx = document.getElementById('laporanChart');
    if(ctx){
        // ensure canvas has explicit height for responsive behavior
        ctx.height = 320;
        const gradient = ctx.getContext('2d').createLinearGradient(0,0,0,320);
        gradient.addColorStop(0, 'rgba(89,134,101,0.85)');
        gradient.addColorStop(1, 'rgba(89,134,101,0.25)');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Laporan Bulanan',
                    data: data,
                    backgroundColor: gradient,
                    borderColor: '#3f8a63',
                    borderWidth: 1,
                    maxBarThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.04)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                }
            }
        });

        // handle jadwal prev/next and modal interactions
        const jadwalCard = document.getElementById('jadwalCard');
        if(jadwalCard){
            const btnPrev = document.getElementById('jadwalPrev');
            const btnNext = document.getElementById('jadwalNext');
            const dateDisplay = document.getElementById('jadwalDate');
            const timeDisplay = document.getElementById('jadwalTime');

            function toISO(d){ return d.toISOString().slice(0,10); }
            function formatDate(idate){
                try{
                    return new Date(idate).toLocaleDateString('id-ID',{ weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
                }catch(e){ return idate; }
            }
function shiftDateBy(days){
                const current = new Date(jadwalCard.getAttribute('data-date'));
                current.setDate(current.getDate() + days);
                const iso = toISO(current);
                jadwalCard.setAttribute('data-date', iso);
                dateDisplay.textContent = formatDate(iso);
            }

            if(btnPrev) btnPrev.addEventListener('click', function(){ shiftDateBy(-1); });
            if(btnNext) btnNext.addEventListener('click', function(){ shiftDateBy(1); });


        }
    }
    // Ringkasan (doughnut)
    const ringCtx = document.getElementById('ringkasanChart');
    if(ringCtx){
            // size the doughnut canvas to match its container for responsiveness
            function setRingCanvasSize(){
                const container = ringCtx.closest('.ringkasan-widget');
                if(!container) return;
                const max = 200;
                const size = Math.min(max, Math.max(80, Math.floor(container.clientWidth)));
                // set CSS size to ensure canvas uses available space
                ringCtx.style.width = size + 'px';
                ringCtx.style.height = size + 'px';
                // also set canvas element width/height attributes to help crisp rendering on some devices
                ringCtx.width = Math.round(size * (window.devicePixelRatio || 1));
                ringCtx.height = Math.round(size * (window.devicePixelRatio || 1));
                if(window.ringChart && typeof window.ringChart.resize === 'function'){
                    try{ window.ringChart.resize(); } catch(e){ /* ignore */ }
                }
            }
            setRingCanvasSize();
        const ringData = [10, 7];
        const ringLabels = ['Menunggu Verifikasi','Terverifikasi'];
        // expose to global so modal logic can update counts
        window.ringData = ringData;
        window.ringLabels = ringLabels; 

        // draw centered text inside doughnut using a Chart.js plugin for perfect centering
        const centerTextPlugin = {
            id: 'centerText',
            afterDraw(chart) {
                // If a DOM overlay for the center exists (for accessibility/responsiveness), don't draw text in canvas
                if(document.getElementById('ringkasanCenter')) return;
                const {ctx, chartArea: {left, right, top, bottom}} = chart;
                const cfg = (chart.options && chart.options.plugins && chart.options.plugins.centerText) || {};
                const centerX = (left + right) / 2;
                const centerY = (top + bottom) / 2;
                ctx.save();
                // Line 1 (big number)
                ctx.fillStyle = cfg.color || '#222';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                const largeSize = cfg.fontSize || Math.round(Math.min(chart.width * 0.12, 28));
                ctx.font = 'bold ' + largeSize + 'px Poppins, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial';
                ctx.fillText(cfg.line1 || '', centerX, centerY - (cfg.lineSpacing || 6));
                // Line 2 (small label)
                const smallSize = cfg.subFontSize || Math.round(Math.max(11, largeSize * 0.45));
                ctx.font = smallSize + 'px Poppins, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial';
                ctx.fillStyle = cfg.subColor || '#6c757d';
                ctx.fillText(cfg.line2 || '', centerX, centerY + (cfg.lineSpacing || 12));
                ctx.restore();
            }
        };

        // register plugin first so it's active on initial draw
        Chart.register(centerTextPlugin);

        const ringChart = new Chart(ringCtx, {
            type: 'doughnut',
            data: {
labels: ringLabels,
                datasets: [{
                    data: ringData,
                    backgroundColor: ['#ffc107','#28a745'],
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    centerText: { line1: String(ringData.reduce((a,b)=>a+b,0)), line2: 'Total', fontSize: 24, subFontSize: 12, lineSpacing: 8 },
                    legend: { display: false },
                    tooltip: { callbacks: { label: function(ctx){
                        const value = ctx.raw;
                        const total = ctx.dataset.data.reduce((a,b)=>a+b,0);
                        const pct = total ? Math.round((value/total)*100) : 0;
                        return ctx.label + ': ' + value + ' (' + pct + '%)';
                    } } }
                }
            }
        });

        // expose reference and add robust resize handling using ResizeObserver
        window.ringChart = ringChart;
        const ringContainer = ringCtx.closest('.ringkasan-widget');
        if(window.ResizeObserver && ringContainer){
            const ro = new ResizeObserver(() => { setRingCanvasSize(); if(window.ringChart && window.ringChart.resize) window.ringChart.resize(); });
            ro.observe(ringContainer);
            // in case initial layout changes shortly after load, double-check size
            setTimeout(function(){ setRingCanvasSize(); if(window.ringChart && window.ringChart.resize) window.ringChart.resize(); }, 120);
        } else {
            // fallback
            window.addEventListener('resize', function(){ setTimeout(function(){ setRingCanvasSize(); if(window.ringChart && window.ringChart.resize) window.ringChart.resize(); }, 80); });
        }

        // update center total + badges + progress automatically
        const total = window.ringData.reduce((a,b)=>a+b,0);
        const selesai = window.ringData[1] || 0;
        const selesaiPct = total ? Math.round((selesai/total)*100) : 0;
        document.getElementById('ringkasanTotal').textContent = total;
        document.getElementById('badge-menunggu').textContent = 'Menunggu: ' + window.ringData[0];
        document.getElementById('badge-terverifikasi').textContent = 'Terverifikasi: ' + window.ringData[1];
        document.getElementById('ringkasanProgress').style.width = selesaiPct + '%';
        document.getElementById('ringkasanProgressText').textContent = selesaiPct + '% laporan terverifikasi hari ini';
    }});
</script>

@endpush


@endsection