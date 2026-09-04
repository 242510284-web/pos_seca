@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container my-4">
    <h4 class="fw-bold mb-3">Tambah Produk</h4>

    {{-- Menampilkan pesan error validasi jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger rounded-3 mb-3">
            <strong class="d-block mb-1">Terjadi kesalahan input:</strong>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('produk._form')
    </form>
</div>
@endsection