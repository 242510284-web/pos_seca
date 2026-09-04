@extends('layouts.app')

@section('content')
<div class="container my-4" style="max-width: 600px;">
    <h3 class="text-primary fw-bold mb-3">Edit Jenis Produk</h3>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('jenis-produk.update', $jenisProduk->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Jenis Produk</label>
                    <input 
                        type="text" 
                        name="nama" 
                        id="nama" 
                        class="form-control @error('nama') is-invalid @enderror" 
                        value="{{ old('nama', $jenisProduk->nama) }}" 
                        required
                    >
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('jenis-produk.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection