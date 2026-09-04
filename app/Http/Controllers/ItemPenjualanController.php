<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request) {
            $sale = Penjualan::where('user_id', Auth::id())
                ->where('status', 'OPEN')
                ->firstOrFail();

            $product = Produk::lockForUpdate()->findOrFail($request->product_id);

            if ($product->stok < $request->quantity) {
                return redirect()->route('penjualan.create')->with('errors', 'Stok produk tidak mencukupi');
            }

            $product->decrement('stok', $request->quantity);

            $item = ItemPenjualan::where('penjualan_id', $sale->id)
                ->where('produk_id', $product->id)
                ->lockForUpdate()
                ->first();

            if ($item) {
                $item->kuantitas += $request->quantity;
            } else {
                $item = new ItemPenjualan([
                    'penjualan_id' => $sale->id,
                    'produk_id'    => $product->id,
                    'kuantitas'    => $request->quantity,
                    'harga_satuan' => $product->harga_jual,
                ]);
            }

            $item->subtotal = $item->kuantitas * $item->harga_satuan;
            $item->save();

            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back();
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request, $id) {
            $item = ItemPenjualan::findOrFail($id);
            $produk = Produk::where('id', $item->produk_id)->lockForUpdate()->first();

            $selisih = $request->quantity - $item->kuantitas;

            if ($selisih > 0) {
                if ($produk->stok < $selisih) {
                    return redirect()->route('penjualan.create')->with('errors', 'Stok tidak mencukupi');
                }
                $produk->decrement('stok', $selisih);
            }

            if ($selisih < 0) {
                $produk->increment('stok', abs($selisih));
            }

            $item->update([
                'kuantitas' => $request->quantity,
                'subtotal'  => $request->quantity * $item->harga_satuan
            ]);

            $item->penjualan->update([
                'total_pembayaran' => $item->penjualan->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back();
    }

    public function destroy($id)
    {
        $item = ItemPenjualan::findOrFail($id);

        // Otorisasi menggunakan instance model $item
        $this->authorize('delete', $item);

        DB::transaction(function () use ($item) {
            // 1. Kembalikan stok ke tabel produk
            $produk = Produk::where('id', $item->produk_id)->lockForUpdate()->first();
            if ($produk) {
                $produk->increment('stok', $item->kuantitas);
            }

            $penjualan = $item->penjualan;

            // 2. Hapus baris item
            $item->delete();

            // 3. Update total pembayaran pada transaksi penjualan
            if ($penjualan) {
                $penjualan->update([
                    'total_pembayaran' => $penjualan->itemPenjualan()->sum('subtotal')
                ]);
            }
        });

        return back();
    }
}