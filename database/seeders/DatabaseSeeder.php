<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\KategoriSarana;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        User::create([
            'nisn' => '1234567890',
            'username' => 'Admin Sekolah',
            'tanggal_lahir' => '1990-01-01',
            'password' => Hash::make('admin123'),
            'email' => 'admin@sekolah.com',
            'phone' => '081234567890',
            'role' => 'admin',
            'is_active' => true
        ]);
    }
}
