<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\JenisProduk;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        if ($keyword) {
            $produk = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();
        } else {
            $produk = Produk::latest()->paginate(10)->withQueryString();
        }

        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisProdukList = JenisProduk::all();
        
        return view('produk.create', compact('jenisProdukList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $dataReq = $request->validated();

        $data = [
            'user_id'         => Auth::id(),
            'jenis_produk_id' => $dataReq['jenis_produk_id'],
            'nama'            => $dataReq['name'],
            'harga_beli'      => $dataReq['purchase_price'],
            'harga_jual'      => $dataReq['selling_price'],
            'stok'            => $dataReq['stock'] ?? 0,
        ];

        // Membaca file gambar dari 'foto' atau 'gambar'
        $fileGambar = $request->file('foto') ?? $request->file('gambar');
        if ($fileGambar) {
            $data['foto'] = $fileGambar->store('products', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $this->authorize('view', $produk);

        return view('produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        $jenisProdukList = JenisProduk::all();

        return view('produk.edit', compact('produk', 'jenisProdukList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $dataReq = $request->validated();

        $data = [
            'user_id'         => Auth::id(),
            'jenis_produk_id' => $dataReq['jenis_produk_id'] ?? $produk->jenis_produk_id,
            'nama'            => $dataReq['name'],
            'harga_beli'      => $dataReq['purchase_price'],
            'harga_jual'      => $dataReq['selling_price'],
            'stok'            => $dataReq['stock'],
        ];

        $fileGambar = $request->file('foto') ?? $request->file('gambar');
        if ($fileGambar) {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            $data['foto'] = $fileGambar->store('products', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}