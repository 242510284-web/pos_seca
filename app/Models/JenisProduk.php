<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisProduk extends Model
{
    use HasFactory;

    // 1. Tambahkan user_id ke fillable
    protected $fillable = [
        'nama',
        'user_id',
    ];

    // 2. Tambahkan relasi ke Model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}