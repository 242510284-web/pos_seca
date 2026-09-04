<div class="card border-0 shadow-sm rounded-4 p-4">
    <h5 class="text-primary fw-bold mb-3">📦 Form Data Produk</h5>

    {{-- 1. Input Gambar / Foto Produk --}}
    <div class="mb-3">
        <label for="foto" class="form-label fw-semibold">Gambar Produk</label>
        <input type="file" 
               class="form-control @error('foto') is-invalid @enderror @error('gambar') is-invalid @enderror" 
               id="foto" 
               name="foto" 
               accept="image/*">
        @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @error('gambar')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- 2. Input Nama Produk --}}
    <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Nama Produk</label>
        <input type="text" 
               class="form-control @error('name') is-invalid @enderror @error('nama_produk') is-invalid @enderror" 
               id="name" 
               name="name" 
               value="{{ old('name', old('nama_produk', $produk->nama ?? '')) }}" 
               placeholder="Masukkan nama produk" 
               required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @error('nama_produk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- 3. Input Jenis Produk (Dropdown) --}}
    <div class="mb-3">
        <label for="jenis_produk_id" class="form-label fw-semibold">Jenis Produk</label>
        <select name="jenis_produk_id" id="jenis_produk_id" class="form-select @error('jenis_produk_id') is-invalid @enderror" required>
            <option value="" disabled {{ old('jenis_produk_id', $produk->jenis_produk_id ?? '') == '' ? 'selected' : '' }}>-- Pilih Jenis Produk --</option>
            
            @if(isset($jenisProdukList) && $jenisProdukList->count() > 0)
                {{-- Data Dinamis dari Database --}}
                @foreach($jenisProdukList as $jenis)
                    <option value="{{ $jenis->id }}" {{ old('jenis_produk_id', $produk->jenis_produk_id ?? '') == $jenis->id ? 'selected' : '' }}>
                        {{ $jenis->nama }}
                    </option>
                @endforeach
            @else
                {{-- Fallback Pilihan Manual --}}
                <option value="1" {{ old('jenis_produk_id', $produk->jenis_produk_id ?? '') == '1' ? 'selected' : '' }}>Alat Gym</option>
                <option value="2" {{ old('jenis_produk_id', $produk->jenis_produk_id ?? '') == '2' ? 'selected' : '' }}>Alat Atletik</option>
                <option value="3" {{ old('jenis_produk_id', $produk->jenis_produk_id ?? '') == '3' ? 'selected' : '' }}>Olahraga Bola</option>
            @endif
        </select>
        @error('jenis_produk_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- 4. Input Harga Beli & Harga Jual --}}
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="purchase_price" class="form-label fw-semibold">Harga Beli</label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" 
                       class="form-control @error('purchase_price') is-invalid @enderror @error('harga_beli') is-invalid @enderror" 
                       id="purchase_price" 
                       name="purchase_price" 
                       value="{{ old('purchase_price', old('harga_beli', $produk->harga_beli ?? 0)) }}" 
                       required>
            </div>
            @error('purchase_price')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            @error('harga_beli')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="selling_price" class="form-label fw-semibold">Harga Jual</label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" 
                       class="form-control @error('selling_price') is-invalid @enderror @error('harga_jual') is-invalid @enderror" 
                       id="selling_price" 
                       name="selling_price" 
                       value="{{ old('selling_price', old('harga_jual', $produk->harga_jual ?? 0)) }}" 
                       required>
            </div>
            @error('selling_price')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            @error('harga_jual')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- 5. Input Jumlah Stok --}}
    <div class="mb-3">
        <label for="stock" class="form-label fw-semibold">Jumlah Stok</label>
        <input type="number" 
               class="form-control @error('stock') is-invalid @enderror @error('stok') is-invalid @enderror" 
               id="stock" 
               name="stock" 
               value="{{ old('stock', old('stok', $produk->stok ?? 0)) }}" 
               required>
        @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @error('stok')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Tombol Aksi --}}
    <div class="mt-4">
        <button type="submit" class="btn btn-success me-2">
            <i class="bi bi-check-circle"></i> Simpan
        </button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>