<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    
    protected $fillable = [
        'user_id',
        'jenis_produk_id', // <-- WAJIB DITAMBAHKAN
        'foto',
        'nama',
        'harga_beli',
        'harga_jual',
        'stok'
    ];

    // Relasi ke Jenis Produk
    public function jenisProduk() {
        return $this->belongsTo(JenisProduk::class, 'jenis_produk_id');
    }

    // 1 produk memiliki banyak item penjualan
    public function itemPenjualan() {
        return $this->hasMany(ItemPenjualan::class, 'produk_id');
    }

    // Relasi ke User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}