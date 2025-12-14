@extends('layouts.petugas-layout')

@section('content')

<div class="container-fluid py-4 dashboard-bg" style="background-color : #DDE6D1">

    <h3 class="text-center mb-4" style="font-family:'poppins'; font-weight: bold;">Pengaturan Jadwal Pengangkutan</h3>

    <!-- Top Section: Form -->
    <div class="card mb-4" style="border-radius:12px; background:#f4f7f2;">
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
    <div class="card" style="border-radius:12px;background-color:#f4f7f2">
        <div class="card-body">
            <div class="table-responsive" style="background-color: #F4F7F2;">
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr class="text-muted small" style="text-align: center; background: #f4f7f2">
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

@endsection
