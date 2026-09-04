<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'            => 'required|string|max:255',
            'jenis_produk_id' => 'required',
            'purchase_price'  => 'required|numeric',
            'selling_price'   => 'required|numeric',
            'stock'           => 'required|integer',
            // Gunakan 'file' agar tidak memicu error mimes strict
            'foto'            => 'nullable|file|max:5120',
            'gambar'          => 'nullable|file|max:5120',
        ];
    }
}