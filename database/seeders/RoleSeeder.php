<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role; // <--- TAMBAHKAN BARIS INI

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan huruf kecil 'create' (opsional, tapi standar Laravel)
        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'kasir'
        ]);
    }
}
