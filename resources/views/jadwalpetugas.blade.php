@extends('layouts.petugas-layout')

@section('content')

<div class="container-fluid py-4 dashboard-bg" style="background-color : #DDE6D1">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <h3 class="text-center mb-4" style="font-family:'poppins'; font-weight: bold;">Pengaturan Jadwal Pengangkutan</h3>

    <!-- Top Section: Form -->
    <div class="card mb-4" style="border-radius:12px; background:#f4f7f2;">
        <div class="card-body p-4">
            <form action="{{ route('petugas.jadwal.store') }}" method="POST">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label class="form-label small" style="font-family:'poppins';">Lokasi :</label>
                        <input type="text" name="lokasi" class="form-control form-control-sm" placeholder="Lokasi Anda ...." style="background: white;font-family:'poppins';" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small" style="font-family:'poppins'; ">Tanggal :</label>
                        <input type="date" name="tanggal" class="form-control form-control-sm" style="background: white;font-family:'poppins';" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small" style="font-family:'poppins';">Waktu :</label>
                        <input type="time" name="waktu" class="form-control form-control-sm" style="background: white;font-family:'poppins';" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small" style="font-family:'poppins';">Deskripsi :</label>
                        <input type="text" name="deskripsi" class="form-control form-control-sm" placeholder="Deskripsi ..." style="background: white;font-family:'poppins';">
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
                            <th style="font-family:'poppins';">Deskripsi</th>
                            <th style="font-family:'poppins';">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwals as $jadwal)
                        <tr class="border-top">
                            <td style="text-align: left;font-family:'poppins';">{{ $jadwal->lokasi }}</td>
                            <td style="text-align: center;font-family:'poppins';">{{ $jadwal->tanggal->format('d/m/Y') }}</td>
                            <td style="text-align: center;font-family:'poppins';">{{ $jadwal->waktu->format('H:i') }}</td>
                            <td style="text-align: center;font-family:'poppins';">{{ $jadwal->deskripsi ?? '-' }}</td>
                            <td style="text-align: center;">
                                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editJadwal({{ $jadwal->id }}, '{{ $jadwal->tanggal->format('Y-m-d') }}', '{{ $jadwal->waktu->format('H:i') }}', '{{ addslashes($jadwal->lokasi) }}', '{{ addslashes($jadwal->deskripsi ?? '') }}')">Edit</button>
                                <form action="{{ route('petugas.jadwal.destroy', $jadwal) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editTanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="editTanggal" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="editWaktu" class="form-label">Waktu</label>
                        <input type="time" class="form-control" id="editWaktu" name="waktu" required>
                    </div>
                    <div class="mb-3">
                        <label for="editLokasi" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="editLokasi" name="lokasi" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function editJadwal(id, tanggal, waktu, lokasi, deskripsi) {
    document.getElementById('editForm').action = '{{ url("petugas/jadwal") }}/' + id;
    document.getElementById('editTanggal').value = tanggal;
    document.getElementById('editWaktu').value = waktu;
    document.getElementById('editLokasi').value = lokasi;
    document.getElementById('editDeskripsi').value = deskripsi;
}
</script>
@endpush
