@extends('layouts.petugas-layout')

@push('styles')
<style>
@media (max-width:575.98px) {
    /* Make filters wrap on small screens */
    .filters-row { display:flex; gap:0.5rem; flex-wrap:wrap; }
    .filters-row .dropdown, .filters-row .input-group { flex:1 1 100%; }
    .filters-row .dropdown .btn, .filters-row .input-group .btn { width:100%; }

    /* Convert tables to stacked cards */
    .table-responsive table thead { display: none; }
    .table-responsive table tbody tr { display: block; border: 1px solid #e9ecef; border-radius: 8px; margin-bottom: 12px; padding: 8px; background: #fff; }
    .table-responsive table tbody td { display: flex; justify-content: space-between; padding: 6px 8px; }
    .table-responsive table tbody td[data-label]::before { content: attr(data-label) ': '; font-weight: 600; color: #6c757d; margin-right: 6px; }
    .table-responsive table tbody td.action-center { justify-content: flex-end; }
    .btn.detail-btn { width: 100%; }
}
</style>
@endpush

@section('content')

<div class="container-fluid py-4 dashboard-bg" style="background-color : #DDE6D1">

    <h3 class="text-center mb-4" style="font-family:'poppins'; font-weight: bold;">Daftar Laporan Masuk</h3>

    <!-- Pending Laporans -->
    <div class="card mb-4" style="border-radius:12px;background-color:#F4F7F2;">
        <div class="card-body">
            <h6 class="mb-3" style="font-family:'poppins';">Menunggu Verifikasi</h6>

            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr class="text-muted small" style="text-align: center;font-family:'poppins';">
                            <th style="text-align: center;">ID Laporan</th>
                            <th style="text-align: center;">Tanggal Laporan</th>
                            <th style="text-align: center;">Lokasi</th>
                            <th style="text-align: center;">Judul</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingLaporans as $laporan)
                        <tr class="border-top">
                            <td data-label="ID Laporan" style="text-align: center;font-family:'poppins';">#{{ $laporan->id }}</td>
                            <td data-label="Tanggal" style="text-align: center;font-family:'poppins';">{{ $laporan->created_at->format('Y-m-d') }}</td>
                            <td data-label="Lokasi" style="text-align: center;font-family:'poppins';">{{ $laporan->lokasi }}</td>
                            <td data-label="Judul" style="text-align: center;font-family:'poppins';">{{ $laporan->judul }}</td>
                            <td data-label="Aksi" class="action-center" style="display:flex; justify-content:center; align-items:center;">
                                <form action="{{ route('petugas.laporan.verify', $laporan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm" style="background:#598665; color:#fff; font-family:'poppins'; padding:6px 10px; border-radius:6px; border:none;">Verifikasi</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Verified Laporans -->
    <div class="card mb-4" style="border-radius:12px;background-color:#F4F7F2;">
        <div class="card-body">
            <h6 class="mb-3" style="font-family:'poppins';">Laporan Terverifikasi</h6>

            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr class="text-muted small" style="text-align: center;font-family:'poppins';">
                            <th style="text-align: center;">ID Laporan</th>
                            <th style="text-align: center;">Tanggal Laporan</th>
                            <th style="text-align: center;">Lokasi</th>
                            <th style="text-align: center;">Judul</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($verifiedLaporans as $laporan)
                        <tr class="border-top">
                            <td data-label="ID Laporan" style="text-align: center;font-family:'poppins';">#{{ $laporan->id }}</td>
                            <td data-label="Tanggal" style="text-align: center;font-family:'poppins';">{{ $laporan->created_at->format('Y-m-d') }}</td>
                            <td data-label="Lokasi" style="text-align: center;font-family:'poppins';">{{ $laporan->lokasi }}</td>
                            <td data-label="Judul" style="text-align: center;font-family:'poppins';">{{ $laporan->judul }}</td>
                            <td data-label="Status" style="text-align: center;font-family:'poppins';">{{ ucfirst($laporan->status) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

        <!-- Filters (Status / Lokasi / Jenis Sampah / Search) -->
        <div class="d-flex gap-2 mb-3 filters-row">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">Status</button>
                <ul class="dropdown-menu">
                   <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Semua</a></li>
                   <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Menunggu Verifikasi</a></li>
                   <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Diproses</a></li>
                   <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Terverifikasi</a></li>
                   <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Ditolak/Invalid</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" style="font-family:'poppins'; ">Lokasi</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Semua</a></li>
                    <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Lokasi A</a></li>
                    <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Lokasi B</a></li>
                    <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Lokasi C</a></li>
                    <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Lokasi D</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" style="font-family:'poppins';">Jenis Sampah</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Semua</a></li>
                    <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Organik</a></li>
                    <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Anorganik</a></li>
                    <li><a class="dropdown-item" href="#" style="font-family:'poppins';">Plastik</a></li>
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
                            @php
                                $allLaporans = \App\Models\Laporan::with('user')->orderBy('created_at', 'desc')->get();
                            @endphp
                            @foreach($allLaporans as $laporan)
                            <tr>
                                <td data-label="ID Laporan" style="text-align: center;font-family:'poppins'; ">#{{ $laporan->id }}</td>
                                <td data-label="Tanggal" style="text-align: center ;font-family:'poppins'; ">{{ $laporan->created_at->format('Y-m-d') }}</td>
                                <td data-label="Lokasi" style="text-align: center;font-family:'poppins'; ">{{ $laporan->lokasi }}</td>
                                <td data-label="Jenis" style="text-align: center;font-family:'poppins';">{{ $laporan->jenis_sampah ?? 'N/A' }}</td>
                                <td data-label="Aksi" class="action-center" style="display:flex; justify-content:center; align-items:center;">
                                    <button class="detail-btn btn btn-sm" style="background-color: #d7e2de; font-family:'poppins'; color:#000; padding:6px 10px; border-radius:6px; border:none;" data-bs-toggle="modal" data-bs-target="#updateStatusModal" data-id="#{{ $laporan->id }}" data-status="{{ ucfirst($laporan->status) }}">Lihat Detail</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>

<!-- Modal: Update Status -->
<div class="modal fade" id="updateStatusModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background: #DDE6D1;">
        <h5 class="modal-title" style="font-family:'poppins'; font-weight: bold;">Update Status Laporan : <span id="modal-laporan-id">-</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateStatusForm" method="POST" action="#">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <p class="text-muted small" style="font-family:'poppins';">Status saat ini: <strong id="modal-current-status">-</strong></p>

            <div class="mb-3">
                <label class="form-label" style="font-family:'poppins';">Pilih Status Baru</label>
                <select class="form-select" id="newStatus" name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="pending">Menunggu Verifikasi</option>
                    <option value="verified">Terverifikasi</option>
                </select>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    var updateModal = document.getElementById('updateStatusModal');
    updateModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var laporanId = button.getAttribute('data-id').replace('#', '');
        var status = button.getAttribute('data-status');

        document.getElementById('modal-laporan-id').textContent = '#' + laporanId;
        document.getElementById('modal-current-status').textContent = status;

        // set action
        document.getElementById('updateStatusForm').action = '{{ url("petugas/laporan") }}/' + laporanId + '/status';

        // reset form
        document.getElementById('newStatus').value = '';
    });

    // remove rejection logic
});
</script>
@endsection

@endsection
