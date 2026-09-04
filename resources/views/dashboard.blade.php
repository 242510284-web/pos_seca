@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<div class="container my-4">
    <!-- Judul Ringkasan Hari Ini -->
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary display-6 mb-1">
            Ringkasan Hari Ini 
            <span class="fs-5 text-secondary fw-normal">({{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }})</span>
        </h2>
    </div>

    <!-- Section 1: Today's Sales -->
    <div class="mb-4">
        <h5 class="fw-bold text-primary border-start border-4 border-primary ps-2 mb-3">Today's Sales</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-primary text-white fw-semibold py-2">
                        Total Nilai Penjualan Hari Ini
                    </div>
                    <div class="card-body text-center py-4">
                        <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalPenjualanHariIni ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-primary text-white fw-semibold py-2">
                        Jumlah Transaksi Hari Ini
                    </div>
                    <div class="card-body text-center py-4">
                        <h3 class="fw-bold mb-0 text-dark">{{ $jumlahTransaksiHariIni ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Cash & Payment Status -->
    <div class="mb-4">
        <h5 class="fw-bold text-primary border-start border-4 border-primary ps-2 mb-3">Cash & Payment Status</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-info text-white fw-semibold py-2">
                        Total Pembayaran Tunai
                    </div>
                    <div class="card-body text-center py-4">
                        <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalTunai ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-info text-white fw-semibold py-2">
                        Total Pembayaran Non-Tunai
                    </div>
                    <div class="card-body text-center py-4">
                        <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalNonTunai ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 3: Critical Inventory Status -->
    <div class="mb-4">
        <h5 class="fw-bold text-primary border-start border-4 border-primary ps-2 mb-3">Critical Inventory Status</h5>
        <div class="row g-3">
            <!-- Tabel Stok Rendah -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white fw-bold text-warning py-3 border-0">
                        <i class="bi bi-exclamation-triangle me-1"></i> Daftar Produk Stok Rendah
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-primary text-primary">
                                    <tr>
                                        <th scope="col" class="px-3">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col" class="text-center">Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stokRendah ?? [] as $index => $item)
                                    <tr>
                                        <td class="px-3">{{ $index + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-center"><span class="badge bg-warning text-dark">{{ $item->stok }}</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">Seluruh produk berada dalam kondisi stok aman</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Produk Habis Stok -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white fw-bold text-danger py-3 border-0">
                        <i class="bi bi-x-circle me-1"></i> Produk Habis Stok
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-primary text-primary">
                                    <tr>
                                        <th scope="col" class="px-3">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col" class="text-center">Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($produkHabis ?? [] as $index => $item)
                                    <tr>
                                        <td class="px-3">{{ $index + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-center"><span class="badge bg-danger">{{ $item->stok }}</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">Tidak ada produk yang habis stok</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection