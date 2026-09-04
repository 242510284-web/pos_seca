@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container my-4">
    @if(session('errors'))
        <div class="alert alert-danger rounded-3 border-0 shadow-sm">
            {{ session('errors') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark mb-0">Halaman Penjualan</h2>
        <a href="{{ route('penjualan.create') }}" class="btn btn-primary rounded-3 px-3">
            + Tambah Penjualan
        </a>
    </div>

    <form action="{{ route('penjualan.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input 
                type="text" 
                name="search" 
                value="{{ request()->search }}" 
                class="form-control border-end-0" 
                placeholder="Cari transaksi atau kasir..."
            >
            <button class="btn btn-outline-secondary bg-white border-start-0" type="submit">
                Search
            </button>
        </div>
    </form>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center py-3" style="width: 50px;">#</th>
                            <th scope="col" class="py-3">Tanggal Transaksi</th>
                            <th scope="col" class="py-3">Kasir</th>
                            <th scope="col" class="py-3">Total Pembayaran</th>
                            <th scope="col" class="py-3">Metode Pembayaran</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="text-center py-3" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <th scope="row" class="text-center text-muted fw-normal">{{ $sales->firstItem() + $loop->index }}</th>
                            <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td class="fw-semibold">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</td>
                            <td><span class="text-uppercase small text-muted fw-bold">{{ $sale->metode_pembayaran }}</span></td>
                            <td>
                                {{-- Soft Badge Status --}}
                                @if($sale->status == 'COMPLETED')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">
                                        COMPLETED
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1">
                                        OPEN
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    {{-- Tombol Detail Outlined --}}
                                    <a href="{{ route('penjualan.show', $sale->id) }}" class="btn btn-outline-primary btn-sm px-2 py-1" title="Detail Transaksi">
                                        Detail
                                    </a>
                                    
                                    @can('view', $sale)
                                        <a href="{{ route('penjualan.edit', $sale->id) }}" class="btn btn-outline-warning btn-sm px-2 py-1" title="Edit Transaksi">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('delete', $sale)
                                        <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="m-0 d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm px-2 py-1" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')" title="Hapus Transaksi">
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Data Tidak Ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $sales->links() }}
    </div>
</div>

@endsection