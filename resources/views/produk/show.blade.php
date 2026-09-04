@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

@include('layouts.navbar')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white fw-bold py-3">
                    Detail Produk
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-5 text-center mb-3 mb-md-0">
                            @if($produk->foto)
                                <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}" class="img-fluid rounded border shadow-sm" style="max-height: 250px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded border d-flex align-items-center justify-content-center text-muted mx-auto" style="height: 200px; width: 100%;">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <div class="col-md-7">
                            <h3 class="fw-bold text-dark mb-3">{{ $produk->nama }}</h3>
                            
                            <table class="table table-borderless align-middle mb-0">
                                <tr>
                                    <td class="text-muted fw-semibold ps-0" style="width: 35%;">Input By</td>
                                    <td>: {{ $produk->user->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold ps-0">Harga Beli</td>
                                    <td>: <span class="text-secondary">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</span></td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold ps-0">Harga Jual</td>
                                    <td>: <span class="fw-bold text-primary">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span></td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold ps-0">Stok</td>
                                    <td>: 
                                        <span class="badge {{ $produk->stok > 10 ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2">
                                            {{ $produk->stok }} unit
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-3 text-end">
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary px-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection