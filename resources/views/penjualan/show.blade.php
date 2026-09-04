@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

{{-- Navbar disembunyikan saat dicetak --}}
<div class="no-print">
    @include('layouts.navbar')
</div>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h3 class="fw-bold text-primary m-0">Detail Transaksi #{{ $penjualan->id }}</h3>
        <div>
            {{-- Tombol Cetak Struk --}}
            <button onclick="window.print()" class="btn btn-success btn-sm me-1">
                🖨️ Cetak Struk
            </button>
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-sm">
                ← Kembali
            </a>
        </div>
    </div>

    {{-- Kartu Info Transaksi --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            {{-- Header Struk (Hanya Muncul Saat Dicetak) --}}
            <div class="text-center d-none d-print-block mb-3">
                <h4 class="fw-bold mb-0">STRUK PENJUALAN</h4>
                <p class="text-muted small mb-0">POS System</p>
                <hr class="my-2">
            </div>

            <div class="row gy-3">
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block">Tanggal Transaksi</small>
                    <strong class="fs-6">{{ $penjualan->created_at->format('d-m-Y H:i:s') }}</strong>
                </div>
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block">Kasir</small>
                    <strong class="fs-6">{{ $penjualan->user->name ?? '-' }}</strong>
                </div>
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block">Metode Pembayaran</small>
                    <span class="badge bg-info text-dark px-3 py-1 fw-bold">
                        {{ $penjualan->metode_pembayaran ?? '-' }}
                    </span>
                </div>
                <div class="col-6 col-md-3">
                    <small class="text-muted d-block">Status</small>
                    <span class="badge {{ $penjualan->status == 'COMPLETED' ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-1">
                        {{ $penjualan->status }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Produk yang Dibeli --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3 no-print">Daftar Produk</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga Satuan</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjualan->itemPenjualan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->produk->nama ?? 'Produk Dihapus' }}</td>
                            <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->kuantitas }}</td>
                            <td class="text-end fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Tidak ada item produk pada transaksi ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="table-primary fw-bold fs-5">
                            <td colspan="4" class="text-end">Total Pembayaran:</td>
                            <td class="text-end">Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Pesan Penutup Struk (Hanya Muncul Saat Dicetak) --}}
            <div class="text-center d-none d-print-block mt-4">
                <p class="mb-0 small">--- Terima Kasih Atas Kunjungan Anda ---</p>
            </div>
        </div>
    </div>
</div>

{{-- CSS Khusus Mode Cetak (Print) --}}
<style>
@media print {
    /* Sembunyikan semua elemen dengan kelas no-print */
    .no-print {
        display: none !important;
    }
    
    /* Atur background dan bayangan card agar hemat tinta */
    body {
        background-color: #fff !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>

@endsection