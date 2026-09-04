@extends('layouts.app')

@section('title', 'Jenis Produk')

@section('content')

@include('layouts.navbar')

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <h2 class="text-primary fw-bold mb-0">
            <i class="bi bi-tag-fill me-2"></i>Jenis produk
        </h2>
        @can('create', App\Models\JenisProduk::class)
            <a href="{{ route('jenis-produk.create') }}" class="btn btn-info text-white fw-semibold">
                + Tambah Jenis Produk
            </a>
        @endcan
    </div>
    <p class="text-secondary mb-4">Kelola jenis produk pada aplikasi POS.</p>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-info text-white fw-bold py-3">
            Daftar Jenis Produk
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 80px;">No</th>
                        <th>Nama Jenis Produk</th>
                        <th>Diinput Oleh</th>
                        <th class="text-center" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisProduks as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->user->name ?? 'Sistem' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    @can('update', $item)
                                        <a href="{{ route('jenis-produk.edit', $item->id) }}" class="btn btn-info btn-sm text-white px-3 d-inline-flex align-items-center">Edit</a>
                                    @endcan
                                    @can('delete', $item)
                                        <form action="{{ route('jenis-produk.destroy', $item->id) }}" method="POST" class="m-0 d-inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm text-white px-3">Hapus</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3 text-muted">Belum ada data jenis produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection