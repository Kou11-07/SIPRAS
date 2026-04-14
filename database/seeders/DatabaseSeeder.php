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
            'name' => 'Admin Sekolah',
            'tanggal_lahir' => '1990-01-01',
            'password' => Hash::make('admin123'),
            'email' => 'admin@sekolah.com',
            'phone' => '081234567890',
            'role' => 'admin',
            'is_active' => true
        ]);

        // Buat User/Siswa Contoh
        User::create([
            'nisn' => '9876543210',
            'name' => 'Budi Santoso',
            'tanggal_lahir' => '2005-05-15',
            'password' => Hash::make('siswa123'),
            'email' => 'budi@student.com',
            'phone' => '081298765432',
            'kelas' => '10 IPA 1',
            'role' => 'user',
            'is_active' => true
        ]);

        // Buat Kategori Sarana
        $kategoriList = [
            'Kursi dan Meja',
            'Papan Tulis',
            'Proyektor/LCD',
            'Komputer/Lab',
            'AC/Kipas Angin',
            'Lampu Penerangan',
            'Toilet Sanitasi',
            'Peralatan Olahraga',
            'Buku Perpustakaan',
            'Lainnya'
        ];

        foreach ($kategoriList as $kategori) {
            KategoriSarana::create([
                'nama' => $kategori,
                'deskripsi' => 'Kategori sarana ' . $kategori,
                'is_active' => true
            ]);
        }

        // Buat Lokasi
        $lokasiList = [
            'Ruang Kelas 10 IPA 1',
            'Ruang Kelas 10 IPA 2',
            'Ruang Kelas 11 IPA 1',
            'Ruang Kelas 11 IPA 2',
            'Ruang Kelas 12 IPA 1',
            'Ruang Kelas 12 IPA 2',
            'Laboratorium IPA',
            'Laboratorium Komputer',
            'Perpustakaan',
            'Lapangan Olahraga',
            'Kantin Sekolah',
            'Toilet Umum',
            'Mushola',
            'Aula Sekolah',
            'Ruang Guru',
            'Ruang Kepala Sekolah',
            'Lainnya'
        ];

        foreach ($lokasiList as $lokasi) {
            Lokasi::create([
                'nama' => $lokasi,
                'deskripsi' => 'Lokasi ' . $lokasi,
                'is_active' => true
            ]);
        }
    }
}