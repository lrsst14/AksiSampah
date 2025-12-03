@extends('layouts.app')

@section('content')

<header class="petugas-header" style="background-color:#ffff;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-1 d-flex align-items-center">
                <img src="{{ asset('img/Gemini_Generated_Image_ckcuywckcuywckcu-removebg-preview.png') }}" alt="Logo" style="width:100px; height:100px; border-radius:50%; object-fit:cover;">
            </div>
            <div class="col-8">
                <!-- Tabs using nav-underline as requested -->
                <ul class="nav nav-underline" id="petugasTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="daftar-tab" data-bs-toggle="tab" data-bs-target="#daftar" href="#daftar" role="tab" aria-controls="daftar" aria-selected="true" style="color: black; font-family:'poppins'; font-weight: bold;">DAFTAR LAPORAN MASUK</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal" href="#jadwal" role="tab" aria-controls="jadwal" aria-selected="false" style="color: black;font-family:'poppins'; font-weight: bold;">PENGATURAN JADWAL PENGANGKUTAN</a>
                    </li>
                </ul>
            </div>
            <div class="col-3 text-end d-flex justify-content-end align-items-center gap-3">
                <a href="{{ route('profile.edit') }}" class="d-flex align-items-center text-decoration-none text-secondary">
                    <img src="{{ asset('img/avatar.png') }}" alt="avatar" style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
                    <span class="ms-2">Bagus R</span>
                </a>
                <a href="{{ route('logout') }}" class="btn btn-sm btn-primary-custom">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid py-4 dashboard-bg" style="background-color : #DDE6D1">

    <div class="tab-content" id="petugasTabContent">
        <!-- DAFTAR LAPORAN MASUK -->
        <div class="tab-pane fade show active" id="daftar" role="tabpanel" aria-labelledby="daftar-tab">
            <h3 class="text-center mb-4" style="font-family:'poppins'; font-weight: bold;">Daftar Laporan Masuk</h3>

            <div class="card mb-4" style="border-radius:12px;">
                <div class="card-body">
                    <h6 class="mb-3"style="font-family:'poppins';">Prioritas : Menunggu Verifikasi</h6>

                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead>
                                <tr class="text-muted small" style="text-align: center;font-family:'poppins';">
                                    <th style="text-align: center;">ID Laporan</th>
                                    <th style="text-align: center;">Tanggal Laporan</th>
                                    <th style="text-align: center;">Lokasi</th>
                                    <th style="text-align: center;">Jenis Sampah</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=1;$i<=4;$i++)
                                <tr class="border-top">
                                    <td style="text-align: center;font-family:'poppins';">#LP-2025-00{{ $i }}</td>
                                    <td style="text-align: center;font-family:'poppins';">2025-12-0{{ $i }}</td>
                                    <td style="text-align: center;font-family:'poppins';">Jl. Contoh No. {{ $i }}</td>
                                    <td style="text-align: center;font-family:'poppins';">Organik</td>
                                    <td class="action-center" style="display:flex; justify-content:center; align-items:center;">
                                        <button class="btn btn-sm" style="background:#d7e2de; color:#000; font-family:'poppins'; padding:6px 10px; border-radius:6px; border:none;" data-bs-toggle="modal" data-bs-target="#updateStatusModal" data-id="#LP-2025-00{{ $i }}" data-status="Menunggu Verifikasi">Lihat Detail</button>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Filters -->
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

            <div class="card mb-5" style="border-radius:12px;">
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
                                    <td style="text-align: center;font-family:'poppins';">Plastik</td>
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

        <!-- PENGATURAN JADWAL PENGANGKUTAN -->
        <div class="tab-pane fade" id="jadwal" role="tabpanel" aria-labelledby="jadwal-tab">
            <h3 class="text-center mb-4" style="font-family:'poppins'; font-weight: bold;">Pengaturan Jadwal Pengangkutan</h3>

            <!-- Top Section: Form -->
            <div class="card mb-4" style="border-radius:12px; background:#ffff;">
                <div class="card-body p-4">

                    <form id="addScheduleForm">
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label small" style="font-family:'poppins';">Lokasi :</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Lokasi Anda ...." style="background: white;font-family:'poppins';">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small" style="font-family:'poppins'; ">Tanggal :</label>
                                <input type="date" class="form-control form-control-sm" placeholder="DD/MM/YYYY" style="background: white;font-family:'poppins';">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small" style="font-family:'poppins';">Waktu :</label>
                                <input type="text" class="form-control form-control-sm" placeholder="08.00 - 10.00" style="background: white;font-family:'poppins';">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small" style="font-family:'poppins';">Status :</label>
                                <select class="form-select form-select-sm" style="background: white;font-family:'poppins';">
                                    <option style="font-family:'poppins';">Pilih Status</option>
                                    <option style="font-family:'poppins';">Aktif</option>
                                    <option style="font-family:'poppins';">Non-Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label small" style="font-family:'poppins';">ID Petugas :</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Isi ID Petugas ......" style="background: white;font-family:'poppins';">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small" style="font-family:'poppins';">Nama Petugas :</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Nama Petugas ..." style="background: white;font-family:'poppins';">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small" style="font-family:'poppins';">ID Kendaraan :</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Isi ID Kendaraan ..." style="background: white;font-family:'poppins';">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-light btn-sm me-2" style="background:#d7e2de; font-family:'poppins';">Simpan</button>
                                <button type="reset" class="btn btn-light btn-sm" style="background: #d7e2de;font-family:'poppins';">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bottom Section: Table -->
            <div class="card" style="border-radius:12px;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead>
                                <tr class="text-muted small" style="text-align: center; background: #f0f0f0;">
                                    <th style="text-align: left;">Lokasi</th>
                                    <th style="font-family:'poppins';">Tanggal</th>
                                    <th style="font-family:'poppins';">Waktu</th>
                                    <th style="font-family:'poppins';">Status</th>
                                    <th style="font-family:'poppins';">ID Petugas</th>
                                    <th style="font-family:'poppins';">Nama Petugas</th>
                                    <th style="font-family:'poppins';">ID Kendaraan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=1;$i<=6;$i++)
                                <tr class="border-top">
                                    <td style="text-align: left;font-family:'poppins';">Lokasi {{ $i }}</td>
                                    <td style="text-align: center;font-family:'poppins';">2025-12-{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td style="text-align: center;font-family:'poppins';">08.00 - 10.00</td>
                                    <td style="text-align: center;font-family:'poppins';"><span class="badge bg-success">Aktif</span></td>
                                    <td style="text-align: center;font-family:'poppins';">P-00{{ $i }}</td>
                                    <td style="text-align: center;font-family:'poppins';">Petugas {{ $i }}</td>
                                    <td style="text-align: center;font-family:'poppins';">K-00{{ $i }}</td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    // show bootstrap tab indicator (handled in CSS via active pseudo-element)

    var updateModal = document.getElementById('updateStatusModal');
    updateModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var laporanId = button.getAttribute('data-id');
        var status = button.getAttribute('data-status');

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
});
</script>
@endsection

@endsection
