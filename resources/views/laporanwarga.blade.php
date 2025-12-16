@extends('layouts.warga-layout')

@section('content')
<div class="container-lg px-3 pt-4">

    <!-- Judul -->
    <div class="text-center mb-4">
        <h4 class="fw-bold" style="color:#598665;">
            <i class="fa-solid fa-trash me-2"></i>Laporan Sampah
        </h4>
    </div>

    <!-- Card Form -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom" style="border-color:#e0e0e0 !important;">
            <h6 class="card-title fw-bold mb-0" style="color:#598665;">
                <i class="fa-solid fa-clipboard me-2"></i>Form Pelaporan Sampah
            </h6>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('warga.laporan.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="mb-4">
                    <label class="form-label fw-semibold text-muted">
                        <i class="fa-solid fa-image me-1"></i>
                        Upload Foto Sampah <span class="text-danger">*</span>
                    </label>

                    <input type="file"
                        class="form-control"
                        name="foto"
                        accept="image/*"
                        required
                        onchange="previewFoto(event)">

                    <img id="preview"
                        class="mt-3 rounded d-none"
                        style="max-width:200px;">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-muted">
                        <i class="fa-solid fa-trash me-1"></i>
                        Jenis Sampah <span class="text-danger">*</span>
                    </label>

                    <select class="form-select" name="jenis_sampah" required>
                        <option value="">-- Pilih Jenis Sampah --</option>
                        <option value="Organik">Organik</option>
                        <option value="Plastik">Plastik</option>
                        <option value="Anorganik">Anorganik</option>
                        <option value="B3">B3</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold text-muted">
                            <i class="fa-solid fa-location-dot me-1"></i>
                            Lokasi Anda <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            class="form-control rounded-3"
                            name="lokasi"
                            placeholder="Masukkan lokasi Anda..."
                            required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold text-muted">
                            <i class="fa-solid fa-file-lines me-1"></i>
                            Deskripsi Laporan <span class="text-danger">*</span>
                        </label>

                        <textarea class="form-control rounded-3"
                            rows="5"
                            style="resize: none;"
                            name="deskripsi"
                            placeholder="Tuliskan deskripsi/kondisi sampah yang anda miliki"
                            required></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit"
                        class="btn px-4"
                        style="background:#598665; color:white;">
                        <i class="fa-solid fa-paper-plane me-1"></i>
                        Kirim
                    </button>

                    <a href="{{ route('warga.dashboard') }}"
                        class="btn btn-outline-secondary px-4">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Card Tips -->
    <div class="card border-0 shadow-sm mb-0">
        <div class="card-header bg-white border-bottom" style="border-color:#e0e0e0 !important;">
            <h6 class="card-title fw-bold mb-0" style="color:#598665;">
                <i class="fa-solid fa-lightbulb me-2"></i>Tips Pelaporan
            </h6>
        </div>
        <div class="card-body p-4">
            <ul class="mb-0 ps-3">
                <li class="mb-2">Berikan deskripsi yang jelas dan detail tentang kondisi sampah</li>
                <li class="mb-2">Cantumkan alamat lengkap untuk memudahkan petugas dalam lokalisasi</li>
                <li>Laporan akan diproses dalam 1×24 Jam setelah verifikasi</li>
            </ul>
        </div>
    </div>

</div>

@push('scripts')
<script>
    function previewFoto(event) {
        const img = document.getElementById('preview');
        img.src = URL.createObjectURL(event.target.files[0]);
        img.classList.remove('d-none');
    }
</script>
@endpush