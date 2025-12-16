@extends('layouts.warga-layout')

@section('content')
<div class="container-lg px-3 pt-4">

    <!-- Judul -->
    <div class="text-center mb-4">
        <h4 class="fw-bold" style="color:#598665;">
            <i class="fa-solid fa-graduation-cap me-2"></i>Edukasi Sampah
        </h4>
    </div>

    <!-- Card Edukasi -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <style>
                /* Edukasi tabs styling (matches site theme) */
                .edu-tabs .nav{ overflow-x:auto; -webkit-overflow-scrolling:touch; padding-bottom:.35rem; }
                .edu-tabs .nav::-webkit-scrollbar{ height:6px; }
                .edu-tabs .nav::-webkit-scrollbar-thumb{ background: rgba(0,0,0,0.08); border-radius:10px; }
                .edu-tabs .nav-pills{ display:flex; gap:.5rem; align-items:center; }
                .edu-tabs .nav-pills .nav-link { flex:0 0 auto; border-radius:20px; background: #f4f6f5; color: #333; border:1px solid #e6e6e6; font-weight:500; padding:.5rem 1rem; white-space:nowrap; }
                .edu-tabs .nav-pills .nav-link.active { background: #598665; color: #fff; }
                .edu-card { border:1px solid #eaeaea; border-radius:10px; padding:1.25rem; background:#fff; margin-bottom:1rem; }
                .edu-card.organik { border-color: #cfe9d7; background: #fbfffaf0; }
                .edu-card.anorganik { border-color: #dbeefc; background: #f8fbff; }
                .edu-footer-note { background: rgba(0,0,0,0.03); border-radius:8px; padding:.75rem; margin-top:1rem; font-size:.95rem; }

                /* Mobile adjustments */
                @media (max-width:767px){
                    .edu-tabs .nav-pills .nav-link{ font-size:.95rem; padding:.45rem .7rem; border-radius:16px; }
                    .edu-card{ padding:.9rem; }
                    .edu-card h5{ font-size:1.05rem; }
                    .edu-card ul{ padding-left:1.1rem; margin-bottom:0.5rem; }
                    .edu-footer-note{ font-size:.9rem; padding:.6rem; }
                    .tab-content > .row > [class*="col-"]{ margin-bottom:.5rem; }
                }
            </style>

            <div class="edu-tabs">
                <ul class="nav nav-pills nav-justified mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="jenis-tab" data-bs-toggle="pill" data-bs-target="#jenis" type="button" role="tab" aria-controls="jenis" aria-selected="true">Jenis Sampah</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cara-tab" data-bs-toggle="pill" data-bs-target="#cara" type="button" role="tab" aria-controls="cara" aria-selected="false">Cara Memilah</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="3r-tab" data-bs-toggle="pill" data-bs-target="#3r" type="button" role="tab" aria-controls="3r" aria-selected="false">3R</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="faq-tab" data-bs-toggle="pill" data-bs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false">FAQ</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="jenis" role="tabpanel" aria-labelledby="jenis-tab">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="edu-card organik shadow-sm">
                                    <h5 class="fw-bold text-success"><i class="fa-solid fa-leaf me-2"></i>Sampah Organik</h5>
                                    <p class="text-muted">Sampah yang berasal dari makhluk hidup dan dapat terurai secara alami.</p>
                                    <ul class="mb-2">
                                        <li>Sisa makanan dan sayuran</li>
                                        <li>Daun dan ranting</li>
                                        <li>Kulit buah</li>
                                        <li>Kertas dan kardus (kotoran ringan)</li>
                                    </ul>
                                    <div class="edu-footer-note text-success"><i class="fa-solid fa-lightbulb me-2"></i>Dapat dijadikan kompos atau pupuk organik</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="edu-card anorganik shadow-sm">
                                    <h5 class="fw-bold text-primary"><i class="fa-solid fa-trash-can me-2"></i>Sampah Anorganik</h5>
                                    <p class="text-muted">Sampah yang tidak dapat terurai secara alami atau membutuhkan waktu sangat lama.</p>
                                    <ul class="mb-2">
                                        <li>Plastik (botol, kantong)</li>
                                        <li>Kaleng dan logam</li>
                                        <li>Kaca dan botol</li>
                                        <li>Styrofoam</li>
                                    </ul>
                                    <div class="edu-footer-note text-primary"><i class="fa-solid fa-recycle me-2"></i>Dapat didaur ulang menjadi produk baru</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="cara" role="tabpanel" aria-labelledby="cara-tab">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="edu-card shadow-sm">
                                    <h6 class="fw-bold"><i class="fa-solid fa-hand-holding-droplet me-2 text-success"></i>Pisahkan di Sumber</h6>
                                    <p class="text-muted small mb-0">Pisahkan sampah organik dan anorganik di rumah agar proses pengolahan lebih efisien.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="edu-card shadow-sm">
                                    <h6 class="fw-bold"><i class="fa-solid fa-bag-shopping me-2 text-primary"></i>Gunakan Label</h6>
                                    <p class="text-muted small mb-0">Gunakan kantong atau tempat berbeda dan beri label untuk tiap jenis sampah.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="edu-card shadow-sm">
                                    <h6 class="fw-bold"><i class="fa-solid fa-recycle me-2 text-warning"></i>Siapkan Daur Ulang</h6>
                                    <p class="text-muted small mb-0">Bersihkan dan keringkan kemasan sebelum dikumpulkan untuk daur ulang.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="3r" role="tabpanel" aria-labelledby="3r-tab">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="edu-card shadow-sm text-center">
                                    <h6 class="fw-bold">Reduce</h6>
                                    <p class="text-muted small mb-0">Kurangi pemakaian barang sekali pakai.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="edu-card shadow-sm text-center">
                                    <h6 class="fw-bold">Reuse</h6>
                                    <p class="text-muted small mb-0">Gunakan kembali barang jika memungkinkan.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="edu-card shadow-sm text-center">
                                    <h6 class="fw-bold">Recycle</h6>
                                    <p class="text-muted small mb-0">Daur ulang material menjadi produk baru.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                        <div class="accordion" id="eduFaq">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Bagaimana cara memulai memilah sampah di rumah?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="faqOne" data-bs-parent="#eduFaq">
                                    <div class="accordion-body text-muted">Mulai dengan menyediakan dua tempat sampah sederhana dan biasakan keluarga untuk memilah setiap hari.</div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Apakah semua plastik bisa didaur ulang?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#eduFaq">
                                    <div class="accordion-body text-muted">Tidak semua plastik dapat didaur ulang: pastikan jenis plastik dan kebersihan kemasan sebelum dikumpulkan.</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection