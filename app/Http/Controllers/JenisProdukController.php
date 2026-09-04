<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JenisProduk;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JenisProdukController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // Menggunakan eager loading (with('user')) agar performa lebih cepat saat menampilkan nama penginput
        $jenisProduks = JenisProduk::with('user')->latest()->get();
        return view('jenis_produk.index', compact('jenisProduks'));
    }

    public function create()
    {
        $this->authorize('create', JenisProduk::class);
        return view('jenis_produk.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', JenisProduk::class);
        
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);
        
        // Menyimpan nama jenis produk sekaligus user_id pengguna yang sedang login
        JenisProduk::create([
            'nama'    => $request->nama,
            'user_id' => auth()->id(),
        ]);
        
        return redirect()->route('jenis-produk.index')->with('success', 'Jenis produk berhasil ditambahkan');
    }

    public function edit(JenisProduk $jenisProduk)
    {
        $this->authorize('update', $jenisProduk);
        return view('jenis_produk.edit', compact('jenisProduk'));
    }

    public function update(Request $request, JenisProduk $jenisProduk)
    {
        $this->authorize('update', $jenisProduk);
        
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);
        
        $jenisProduk->update($request->only('nama'));
        
        return redirect()->route('jenis-produk.index')->with('success', 'Jenis produk berhasil diperbarui');
    }

    public function destroy(JenisProduk $jenisProduk)
    {
        $this->authorize('delete', $jenisProduk);
        
        $jenisProduk->delete();
        
        return redirect()->route('jenis-produk.index')->with('success', 'Jenis produk berhasil dihapus');
    }
}