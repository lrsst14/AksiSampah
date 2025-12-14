@extends('layouts.petugas-layout')

@section('content')

<style>
/* Make Jadwal controls and Ringkasan responsive */
@media (max-width: 767.98px) {
    .jadwal-header { flex-direction: column !important; align-items: flex-start !important; gap: .75rem !important; }
    .jadwal-header .ms-auto { width: 100%; display:flex; gap:.5rem; }
    .jadwal-header .ms-auto .btn { flex:1 1 auto; }

    /* Stack the ringkasan card: text first, chart centered underneath */
    .ringkasan-row { flex-direction: column !important; align-items: center !important; text-align: center; }
    .ringkasan-row .flex-grow-1 { width: 100%; }
    .ringkasan-widget { width: 140px; height: 140px; margin-top: .75rem; }
}

/* Small phones: improve wrapping and sizing */
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

/* prevent flex overflow when badges or progress are long */
.ringkasan-row .flex-grow-1 { min-width: 0; }

@media (max-width: 360px) {
    #ringkasanCenter strong { font-size: 14px; }
}

/* defaults */
.ringkasan-widget { width: min(160px, 30vw); max-width:160px; aspect-ratio:1/1; position: relative; display:flex; align-items:center; justify-content:center; }
.ringkasan-widget canvas { width: 100% !important; height: 100% !important; display:block; }
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
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 dashboard-card">
            <span class="text-muted">Menunggu Verifikasi</span>
            <h3 class="text-warning fw-bold">10</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 dashboard-card">
            <span class="text-muted">Terjadwal</span>
            <h3 class="text-primary fw-bold">7</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3 dashboard-card">
            <span class="text-muted">Selesai</span>
            <h3 class="text-success fw-bold">12</h3>
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
        <div class="card border-0 shadow-sm p-4 h-100" id="jadwalCard" data-date="2025-12-20" data-location="Area 12" data-time="09:00">
            <h6 class="fw-semibold">Jadwal Pengangkutan Berikutnya</h6>

            <div class="d-flex align-items-center gap-3 mb-2 jadwal-header">
                <div class="small text-muted me-2">Tanggal:</div>
                <div class="fw-semibold" id="jadwalDate">Rabu, 20 Desember 2025</div>
                <div class="ms-auto d-flex gap-2 flex-column flex-sm-row">
                    <button class="btn btn-sm btn-outline-secondary w-100 w-sm-auto" id="jadwalPrev">&larr; Sebelumnya</button>
                    <button class="btn btn-sm btn-outline-secondary w-100 w-sm-auto" id="jadwalNext">Selanjutnya &rarr;</button>
                </div>
            </div>

            <p class="mb-1">📍 Lokasi: <span id="jadwalLocation">Area 12</span></p>
            <p>⏰ <span id="jadwalTime">09.00 WIB</span></p>

            <div class="d-flex gap-2">
                <button class="btn btn-sm text-white" style="background:#598665" id="jadwalDetailBtn" data-bs-toggle="modal" data-bs-target="#jadwalDetailModal" data-id="1" data-date="2025-12-20" data-location="Area 12" data-time="09:00">Lihat Detail Jadwal</button>
                <a href="{{ route('petugas.jadwal') }}" class="btn btn-outline-secondary btn-sm">Kelola Jadwal</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-semibold">Ringkasan Laporan Hari Ini</h6>

                <div class="d-flex align-items-center gap-3 ringkasan-row">
                <div class="flex-grow-1">
                    <h2 class="fw-bold text-primary mb-1">34 Laporan</h2>
                    <small class="text-muted">Periode: Hari ini &middot; Terakhir diperbarui {{ now()->format('d M Y H:i') }}</small>

                    <div class="d-flex gap-2 mt-3" id="ringkasanBadges">
                        <span class="badge bg-warning text-dark" id="badge-menunggu">Menunggu: 10</span>
                        <span class="badge bg-primary" id="badge-diproses">Diproses: 8</span>
                        <span class="badge bg-success" id="badge-terverifikasi">Terverifikasi: 12</span>
                        <span class="badge bg-danger" id="badge-ditolak">Ditolak/Invalid: 4</span>
                    </div>

                    <div class="mt-3">
                        <div class="progress" style="height:10px; background:#e9f3ec; border-radius:6px; overflow:hidden;">
                            <div class="progress-bar" role="progressbar" id="ringkasanProgress" style="width:35%; background:#3f8a63;"></div>
                        </div>
                        <small class="text-muted" id="ringkasanProgressText">35% laporan terverifikasi hari ini</small>
                    </div>
                </div>

                <div class="ringkasan-widget">
                    <canvas id="ringkasanChart"></canvas>
                    <div class="position-absolute top-50 start-50 translate-middle text-center text-dark" id="ringkasanCenter" style="pointer-events:none;">
                        <strong id="ringkasanTotal" style="font-size:18px;">34</strong>
                        <div class="small text-muted">Total</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="mt-4">

    <!-- Filters (Status / Lokasi / Jenis Sampah / Search) -->
    <div class="d-flex gap-2 mb-3">
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">Status</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Semua</a></li>
                <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Menunggu Verifikasi</a></li>
                <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Diproses</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" style="font-family:'poppins'; ">Lokasi</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Semua</a></li>
                <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Kecamatan A</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" style="font-family:'poppins';">Jenis Sampah</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Semua</a></li>
                <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Organik</a></li>
            </ul>
        </div>
        <div class="ms-auto">
            <div class="input-group">
                <input class="form-control" placeholder="Search" style="font-family:'poppins';">
                <button class="btn" style="background-color: #d7e2de;font-family:'poppins';">Search</button>
            </div>
        </div>
    </div>

    <!-- Semua Laporan -->
    <div class="card mb-5" style="border-radius:12px;background-color:#F4F7F2">
        <div class="card-body">
            <h6 class="mb-3" style="font-family:'poppins';">Semua Laporan</h6>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr class="text-muted small" style="text-align: center;">
                            <th style="font-family:'poppins'; font-weight: bold;">ID Laporan</th>
                            <th style="font-family:'poppins'; font-weight: bold;">Tanggal Laporan</th>
                            <th style="font-family:'poppins'; font-weight: bold;">Lokasi</th>
                            <th style="font-family:'poppins'; font-weight: bold;">Jenis Sampah</th>
                            <th style="text-align:center;font-family:'poppins'; font-weight: bold;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=1;$i<=8;$i++)
                        <tr>
                            <td style="text-align: center;font-family:'poppins'; ">#LP-2025-0{{ $i }}</td>
                            <td style="text-align: center ;font-family:'poppins'; ">2025-12-0{{ $i }}</td>
                            <td style="text-align: center;font-family:'poppins'; ">Jl. Contoh No. {{ $i }}</td>
                            <td style="text-align: center;font-family:'poppins';">{{ $i % 2 ? 'Plastik' : 'Organik' }}</td>
                            <td class="action-center" style="display:flex; justify-content:center; align-items:center;">
                                <button class="btn btn-sm" style="background-color: #d7e2de; font-family:'poppins'; color:#000; padding:6px 10px; border-radius:6px; border:none;" data-bs-toggle="modal" data-bs-target="#updateStatusModal" data-id="#LP-2025-0{{ $i }}" data-status="Menunggu Verifikasi">Lihat Detail</button>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>

<!-- Modal: Update Status -->

<!-- Modal: Jadwal Detail -->
<div class="modal fade" id="jadwalDetailModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background: #DDE6D1;">
        <h5 class="modal-title" style="font-family:'poppins'; font-weight: bold;">Detail Jadwal Pengangkutan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="jadwalDetailForm">
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="jadwalInputDate" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Waktu</label>
                <input type="time" class="form-control" id="jadwalInputTime" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="jadwalInputLocation" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea class="form-control" id="jadwalInputNotes" rows="3" placeholder="(Opsional)"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="updateStatusModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background: #DDE6D1;">
        <h5 class="modal-title" style="font-family:'poppins'; font-weight: bold;">Update Status Laporan : <span id="modal-laporan-id">-</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateStatusForm" method="POST" action="#">
        @csrf
        <div class="modal-body">
            <p class="text-muted small" style="font-family:'poppins';">Status saat ini: <strong id="modal-current-status">-</strong></p>

            <div class="mb-3">
                <label class="form-label" style="font-family:'poppins';">Pilih Status Baru</label>
                <select class="form-select" id="newStatus" name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Terverifikasi">Terverifikasi</option>
                    <option value="Ditolak">Tolak/Invalid</option>
                </select>
            </div>

            <div class="mb-3 d-none" id="rejectionNoteWrap">
                <label class="form-label text-danger" style="font-family:'poppins';">Alasan Penolakan (wajib jika tolak)</label>
                <textarea class="form-control" id="rejectionNote" name="catatan" rows="3"></textarea>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-light btn-sm me-2" style="font-family:'poppins';background :#d7e2de">Simpan</button>
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal" style="font-family:'poppins';background:#d7e2de">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    var updateModal = document.getElementById('updateStatusModal');
    if(updateModal){
        updateModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var laporanId = button ? button.getAttribute('data-id') : '-';
            var status = button ? button.getAttribute('data-status') : '-';

            document.getElementById('modal-laporan-id').textContent = laporanId;
            document.getElementById('modal-current-status').textContent = status;

            // reset form
            document.getElementById('newStatus').value = '';
            document.getElementById('rejectionNoteWrap').classList.add('d-none');
            document.getElementById('rejectionNote').value = '';
        });

        var newStatus = document.getElementById('newStatus');
        newStatus.addEventListener('change', function(){
            var wrap = document.getElementById('rejectionNoteWrap');
            if(this.value === 'Ditolak'){
                wrap.classList.remove('d-none');
                document.getElementById('rejectionNote').setAttribute('required','required');
            } else {
                wrap.classList.add('d-none');
                document.getElementById('rejectionNote').removeAttribute('required');
            }
        });

        // demo submit prevention
        document.getElementById('updateStatusForm').addEventListener('submit', function(e){
            e.preventDefault();
            var id = document.getElementById('modal-laporan-id').textContent;
            var newStatusVal = document.getElementById('newStatus').value;
            var note = document.getElementById('rejectionNote').value;
            var modal = bootstrap.Modal.getInstance(updateModal);
            modal.hide();
            alert('Status untuk ' + id + ' diubah menjadi: ' + newStatusVal + (note ? '\nCatatan: ' + note : ''));
        });
    }
});
</script>

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
            const locDisplay = document.getElementById('jadwalLocation');
            const timeDisplay = document.getElementById('jadwalTime');
            const detailBtn = document.getElementById('jadwalDetailBtn');

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
                detailBtn.setAttribute('data-date', iso);
                dateDisplay.textContent = formatDate(iso);
            }

            btnPrev.addEventListener('click', function(){ shiftDateBy(-1); });
            btnNext.addEventListener('click', function(){ shiftDateBy(1); });

            // Show modal with current data
            const jadwalModal = document.getElementById('jadwalDetailModal');
            if(jadwalModal){
                jadwalModal.addEventListener('show.bs.modal', function(event){
                    const button = event.relatedTarget || detailBtn;
                    const id = button.getAttribute('data-id') || '1';
                    const date = button.getAttribute('data-date') || jadwalCard.getAttribute('data-date');
                    const time = button.getAttribute('data-time') || jadwalCard.getAttribute('data-time');
                    const location = button.getAttribute('data-location') || jadwalCard.getAttribute('data-location');

                    document.getElementById('jadwalInputDate').value = date;
                    document.getElementById('jadwalInputTime').value = time;
                    document.getElementById('jadwalInputLocation').value = location;
                    document.getElementById('jadwalInputNotes').value = '';
                });

                // save changes (demo)
                document.getElementById('jadwalDetailForm').addEventListener('submit', function(e){
                    e.preventDefault();
                    const newDate = document.getElementById('jadwalInputDate').value;
                    const newTime = document.getElementById('jadwalInputTime').value;
                    const newLocation = document.getElementById('jadwalInputLocation').value;

                    jadwalCard.setAttribute('data-date', newDate);
                    jadwalCard.setAttribute('data-time', newTime);
                    jadwalCard.setAttribute('data-location', newLocation);

                    // update displays
                    document.getElementById('jadwalDate').textContent = formatDate(newDate);
                    document.getElementById('jadwalTime').textContent = newTime.replace(':', '.') + ' WIB';
                    document.getElementById('jadwalLocation').textContent = newLocation;

                    var modal = bootstrap.Modal.getInstance(jadwalModal);
                    modal.hide();
                    alert('Jadwal disimpan (demo).');
                });
            }
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
        const ringData = [10, 8, 12, 4];
        const ringLabels = ['Menunggu Verifikasi','Diproses','Terverifikasi','Ditolak/Invalid'];

        const ringChart = new Chart(ringCtx, {
            type: 'doughnut',
            data: {
                labels: ringLabels,
                datasets: [{
                    data: ringData,
                    backgroundColor: ['#ffc107','#0d6efd','#28a745','#dc3545'],
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: function(ctx){
                        const value = ctx.raw;
                        const total = ctx.chart._metasets ? ctx.chart._metasets[0].total : ctx.dataset.data.reduce((a,b)=>a+b,0);
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
        const total = ringData.reduce((a,b)=>a+b,0);
        const verified = ringData[2]; // terverifikasi
        const verifiedPct = Math.round((verified/total)*100);
        document.getElementById('ringkasanTotal').textContent = total;
        document.getElementById('badge-menunggu').textContent = 'Menunggu: ' + ringData[0];
        document.getElementById('badge-diproses').textContent = 'Diproses: ' + ringData[1];
        document.getElementById('badge-terverifikasi').textContent = 'Terverifikasi: ' + ringData[2];
        document.getElementById('badge-ditolak').textContent = 'Ditolak/Invalid: ' + ringData[3];
        document.getElementById('ringkasanProgress').style.width = verifiedPct + '%';
        document.getElementById('ringkasanProgressText').textContent = verifiedPct + '% laporan terverifikasi hari ini';
    }});
</script>

@endpush


@endsection
