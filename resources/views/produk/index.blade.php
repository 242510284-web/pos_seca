@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<div class="container mt-4">
    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Halaman Produk</h2>
            <p class="text-muted small mb-0">Kelola katalog produk, harga, dan ketersediaan stok</p>
        </div>
        
        <!-- Tombol Create (Hanya Admin) -->
        @can('create', App\Models\Produk::class)
        <a href="{{ route('produk.create') }}" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Create
        </a>
        @endcan
    </div>

    <!-- Form Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="input-group">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        class="form-control border-primary-subtle" 
                        placeholder="Search nama produk..."
                    >
                    <button class="btn btn-primary px-4" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Produk -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-primary">
                        <tr>
                            <th scope="col" class="py-3 px-3">#</th>
                            <th scope="col" class="py-3">User</th>
                            <th scope="col" class="py-3">Foto</th>
                            <th scope="col" class="py-3">Nama</th>
                            <th scope="col" class="py-3">Harga Beli</th>
                            <th scope="col" class="py-3">Harga Jual</th>
                            <th scope="col" class="py-3 text-center">Stok</th>
                            <th scope="col" class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produk as $index => $item)
                        <tr>
                            <td class="px-3 fw-semibold text-secondary">
                                {{ method_exists($produk, 'firstItem') ? $produk->firstItem() + $index : $index + 1 }}
                            </td>
                            <td class="text-secondary small">{{ $item->user->name ?? $item->user_id }}</td>
                            <td>
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="rounded border" style="width: 48px; height: 48px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded border d-flex align-items-center justify-content-center text-muted" style="width: 48px; height: 48px; font-size: 0.7rem;">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="fw-bold text-dark">{{ $item->nama }}</td>
                            <td class="text-secondary">Rp. {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                            <td class="fw-semibold text-primary">Rp. {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="badge {{ $item->stok > 10 ? 'bg-info-subtle text-info-emphasis border border-info-subtle' : 'bg-warning-subtle text-warning-emphasis border border-warning-subtle' }} px-2 py-1">
                                    {{ $item->stok }}
                                </span>
                            </td>
                            <td class="d-flex gap-1 justify-content-center">
                                <!-- Tombol Detail (Dapat Dilihat Admin & Kasir) -->
                                @can('view', $item)
                                <a href="{{ route('produk.show', $item->id) }}" class="btn btn-info btn-sm text-white">
                                    Detail
                                </a>
                                @endcan

                                <!-- Tombol Edit (Hanya Admin) -->
                                @can('update', $item)
                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                @endcan

                                <!-- Tombol Hapus (Hanya Admin) -->
                                @can('delete', $item)
                                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                        Hapus
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted text-center py-4">
                                Data produk tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if(method_exists($produk, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $produk->links() }}
        </div>
    @endif
</div>

@endsection