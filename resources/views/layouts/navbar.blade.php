{{-- Pastikan Bootstrap Icons sudah di-include di layout utama (misal di <head>) --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"> --}}

<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
      <i class="bi bi-shop fs-4 text-primary"></i>
      <span>POS</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
        {{-- Menu Dashboard --}}
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 {{ Request::is('dashboard') ? 'active fw-semibold' : '' }}" aria-current="page" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
          </a>
        </li>

        {{-- Hanya tampil jika role admin --}}
        @if(strtolower(auth()->user()->role?->name) === 'admin')
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 {{ Request::is('admin/users*') ? 'active fw-semibold' : '' }}" href="{{ route('admin.users') }}">
            <i class="bi bi-people"></i> Users
          </a>
        </li>
        @endif

        {{-- 1. Menu Jenis Produk --}}
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 {{ Request::is('jenis-produk*') ? 'active fw-semibold' : '' }}" href="{{ route('jenis-produk.index') }}">
            <i class="bi bi-tags"></i> Jenis Produk
          </a>
        </li>

        {{-- 2. Menu Produk --}}
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 {{ Request::is('produk*') ? 'active fw-semibold' : '' }}" href="{{ route('produk.index') }}">
            <i class="bi bi-box-seam"></i> Produk
          </a>
        </li>

        {{-- Menu Penjualan --}}
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 {{ Request::is('penjualan*') ? 'active fw-semibold' : '' }}" href="{{ route('penjualan.index') }}">
            <i class="bi bi-cart-check"></i> Penjualan
          </a>
        </li>

        {{-- Menu Tentang --}}
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 {{ Request::is('tentang*') ? 'active fw-semibold' : '' }}" href="{{ route('tentang.index') }}">
            <i class="bi bi-info-circle"></i> Tentang
          </a>
        </li>
      </ul>

      {{-- Tombol Logout --}}
      <form action="{{ route('logout') }}" method="POST" class="d-flex">
        @csrf
        <button type="submit" class="btn btn-danger d-flex align-items-center gap-1">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
    </div>
  </div>
</nav>

{{-- Header Informasi User --}}
<div class="container mt-4">
  <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 shadow-sm">
    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
         style="width:48px;height:48px;">
      <i class="bi bi-person-fill fs-4"></i>
    </div>
    <div>
      @if(strtolower(auth()->user()->role?->name) === 'admin')
        <span class="badge bg-primary mb-1"><i class="bi bi-shield-lock"></i> Admin</span>
        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
      @else
        <span class="badge bg-secondary mb-1"><i class="bi bi-person-badge"></i> Kasir</span>
        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
      @endif
    </div>
  </div>
</div>

<style>
.navbar-nav .nav-link {
  border-radius: 8px;
  padding: 0.5rem 0.9rem;
  transition: background-color 0.2s ease, color 0.2s ease;
}
.navbar-nav .nav-link:hover {
  background-color: rgba(13, 110, 253, 0.08);
  color: #0d6efd;
}
.navbar-nav .nav-link.active {
  background-color: rgba(13, 110, 253, 0.12);
  color: #0d6efd !important;
}
</style>