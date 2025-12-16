@extends('layouts.warga-layout')

@section('content')

<div class="container-fluid py-4 dashboard-bg">
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h3 class="mb-0" style="font-family:'poppins'; font-weight:700;">Laporan Sampah</h3>
            <small class="text-muted">Laporkan sampah Anda</small>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('warga.laporan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <h5 class="mb-3"><i class="bi bi-journal-plus"></i> Form Pelaporan Sampah</h5>

                    <div class="mb-3">
                        <label class="form-label">Upload Foto Sampah <span class="text-danger">*</span></label>
                        <input type="file" name="foto" accept="image/*" class="form-control" onchange="previewFoto(event)" required>
                        <img id="preview" src="#" alt="Preview Foto" class="img-thumbnail mt-2 d-none" style="max-height:220px;" />
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Sampah <span class="text-danger">*</span></label>
                            <select name="jenis_sampah" class="form-select" required>
                                <option value="">-- Pilih Jenis Sampah --</option>
                                @if(isset($jenisSampah) && count($jenisSampah))
                                @foreach($jenisSampah as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                @endforeach
                                @else
                                <option value="organik">Organik</option>
                                <option value="anorganik">Anorganik</option>
                                <option value="b3">B3</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Berat (gram)</label>
                            <div class="input-group">
                                <input type="number" name="berat_gram" min="1" class="form-control" placeholder="Berapa gram?">
                                <span class="input-group-text">gram</span>
                            </div>
                            <small class="text-muted">Masukkan estimasi berat sampah dalam gram.</small>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Pilih Jadwal <span class="text-danger">*</span></label>
                            <select name="jadwal_id" class="form-select" required>
                                <option value="">-- Pilih Jadwal --</option>
                                @if(isset($jadwals) && count($jadwals))
                                @foreach($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}">{{ $jadwal->hari }} — {{ $jadwal->waktu }}</option>
                                @endforeach
                                @else
                                <option value="">(Belum ada jadwal tersedia)</option>
                                @endif
                            </select>
                            <small class="text-muted">Pilih jadwal yang sudah ditentukan petugas.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lokasi Anda <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" class="form-control" placeholder="Masukkan lokasi Anda..." required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deskripsi Laporan <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan deskripsi/kondisi sampah yang anda miliki" required></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-send-fill"></i> Kirim
                            </button>
                        </div>
                        <div>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h6 class="mb-3"><i class="bi bi-lightbulb-fill"></i> Tips Pelaporan</h6>
            <ul>
                <li>Berikan deskripsi yang jelas dan detail tentang kondisi sampah</li>
                <li>Cantumkan alamat lengkap untuk memudahkan petugas dalam lokalisasi</li>
                <li>Laporan akan diproses dalam 1×24 Jam setelah verifikasi</li>
            </ul>
        </div>
    </div>


    @push('scripts')
    <script>
        function previewFoto(event) {
            const img = document.getElementById('preview');
            if (!event.target.files || !event.target.files[0]) return;
            img.src = URL.createObjectURL(event.target.files[0]);
            img.classList.remove('d-none');
        }
    </script>
    @endpush

    @endsection