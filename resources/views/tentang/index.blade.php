@extends('layouts.app')

@section('title', 'Tentang Aplikasi')

@section('content')

@include('layouts.navbar')
<div class="container my-4">

    {{-- Banner Utama --}}
    <div class="card border-0 shadow rounded-4 text-white p-4 mb-4" style="background: linear-gradient(135deg, #0d6efd, #0b5ed7);">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                <i class="bi bi-dribbble text-primary fs-2"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-1">POS Toko Olahraga</h3>
                <p class="mb-0 text-white-50">Sistem Kasir & Manajemen Stok Ringkas</p>
            </div>
        </div>
    </div>

    {{-- Grid Informasi --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-center h-100">
                <div class="fs-2 mb-2">🏋️</div>
                <small class="text-secondary">Kategori</small>
                <div class="fw-bold text-dark">Alat Gym & Fitness</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-center h-100">
                <div class="fs-2 mb-2">🏃</div>
                <small class="text-secondary">Kategori</small>
                <div class="fw-bold text-dark">Perlengkapan Atletik</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-center h-100">
                <div class="fs-2 mb-2">🏀</div>
                <small class="text-secondary">Kategori</small>
                <div class="fw-bold text-dark">Permainan Bola</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-center h-100">
                <div class="fs-2 mb-2">⚡</div>
                <small class="text-secondary">Versi</small>
                <div class="fw-bold text-primary">v1.0.0 (Laravel 12)</div>
            </div>
        </div>
    </div>

    {{-- Bagian Bawah --}}
    <div class="row g-4">
        {{-- Fitur Utama --}}
        <div class="col-md-6">
            <div class="card border-0 shadow rounded-4 p-4 h-100">
                <h5 class="fw-bold mb-3">🚀 Fitur Utama</h5>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-medium shadow-sm">
                        👤 Admin & Kasir
                    </span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 fw-medium shadow-sm">
                        📦 Stok Produk
                    </span>
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-2 fw-medium shadow-sm">
                        🏷️ Jenis Produk
                    </span>
                    <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle rounded-pill px-3 py-2 fw-medium shadow-sm">
                        💳 Transaksi POS
                    </span>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-2 fw-medium shadow-sm">
                        📑 Riwayat Penjualan
                    </span>
                </div>
            </div>
        </div>

        {{-- Pengembang System --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 p-4 text-white h-100" style="background: #1a5ce6;">
                <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
                    👨‍💻 Pengembang System
                </h5>

                {{-- Profil --}}
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white text-primary rounded-circle fw-bold d-flex align-items-center justify-content-center shadow" style="width: 60px; height: 60px; font-size: 1.2rem;">
                        ICA
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">Ica</h4>
                        <span class="badge bg-white text-primary rounded-pill px-3 py-1 fw-semibold shadow-sm">
                            Siswi SMKN 4 Tasikmalaya
                        </span>
                    </div>
                </div>

                <hr class="border-white opacity-25 my-3">

                {{-- Kotak Putih Identitas (Shadow Dipertegas) --}}
                <div class="bg-white text-dark rounded-4 p-3 mb-3 shadow">
                    <div class="row gy-2 text-start align-items-center" style="font-size: 0.95rem;">
                        <div class="col-4 text-secondary">NIS :</div>
                        <div class="col-8 fw-bold">242510284</div>

                        <div class="col-4 text-secondary">Kelas :</div>
                        <div class="col-8 fw-bold">XII PPLG 4</div>

                        <div class="col-4 text-secondary">Jurusan :</div>
                        <div class="col-8 fw-bold">Pengembangan Perangkat Lunak & Gim</div>

                        <div class="col-4 text-secondary">Tahun Ajaran :</div>
                        <div class="col-8 fw-bold">2026 / 2027</div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <p class="small text-white-50 mb-0">
                    Dikembangkan untuk mempermudah transaksi kasir dan pengelolaan barang toko olahraga secara praktis.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection