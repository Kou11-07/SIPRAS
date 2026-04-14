<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriSarana;

class KategoriSaranaSeeder extends Seeder
{
    public function run()
    {
        $kategori = [
            ['nama' => 'Kursi', 'is_active' => true],
            ['nama' => 'Meja', 'is_active' => true],
            ['nama' => 'Papan Tulis', 'is_active' => true],
            ['nama' => 'Proyektor', 'is_active' => true],
            ['nama' => 'Komputer', 'is_active' => true],
            ['nama' => 'AC/Kipas Angin', 'is_active' => true],
            ['nama' => 'Lampu Penerangan', 'is_active' => true],
            ['nama' => 'Speaker', 'is_active' => true],
            ['nama' => 'Lemari', 'is_active' => true],
            ['nama' => 'Tempat sampah', 'is_active' => true],
        ];

        foreach ($kategori as $kat) {
            KategoriSarana::create($kat);
        }
    }
}