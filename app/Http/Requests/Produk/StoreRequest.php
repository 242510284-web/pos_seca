<?php

namespace App\Http\Requests\Produk;

use Illuminate\Contracts\Validation\ValidationRule;
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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'name' => 'required|string|max:255',
            'jenis_produk_id' => 'required|exists:jenis_produks,id',
            'purchase_price' => 'required|integer|min:0',
            'selling_price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.image' => 'File yang diupload harus gambar.',
            'foto.mimes' => 'Ekstensi gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Maksimal ukuran gambar 5MB.',

            'name.required' => 'Nama wajib diisi.',

            'jenis_produk_id.required' => 'Jenis produk wajib dipilih.',
            'jenis_produk_id.exists' => 'Jenis produk tidak ditemukan.',

            'purchase_price.required' => 'Harga beli wajib diisi.',
            'purchase_price.integer' => 'Harga beli harus berupa bilangan bulat.',

            'selling_price.required' => 'Harga jual wajib diisi.',
            'selling_price.integer' => 'Harga jual harus berupa bilangan bulat.',

            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka.',
        ];
    }
}
