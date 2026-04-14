<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run()
    {
        $lokasi = [
            ['nama' => 'Gedung 1 R1', 'is_active' => true],
            ['nama' => 'Gedung 1 R2', 'is_active' => true],
            ['nama' => 'Gedung 2 R3', 'is_active' => true],
            ['nama' => 'Gedung 2 R4', 'is_active' => true],
            ['nama' => 'Gedung 2 R5', 'is_active' => true],
            ['nama' => 'Gedung 2 R6', 'is_active' => true],
            ['nama' => 'Gedung 3 R7', 'is_active' => true],
            ['nama' => 'Gedung 3 R8', 'is_active' => true],
            ['nama' => 'Gedung 3 R9', 'is_active' => true],
            ['nama' => 'Gedung 3 R10', 'is_active' => true],
            ['nama' => 'Gedung 4 R11', 'is_active' => true],
            ['nama' => 'Gedung 4 R12', 'is_active' => true],
            ['nama' => 'Gedung 5 R13', 'is_active' => true],
            ['nama' => 'Gedung 5 R14', 'is_active' => true],
            ['nama' => 'Gedung 6 R15', 'is_active' => true],
            ['nama' => 'Gedung 6 R15', 'is_active' => true],
            ['nama' => 'Gedung 7 R16', 'is_active' => true],
            ['nama' => 'Gedung 7 R17', 'is_active' => true],
            ['nama' => 'Gedung 8 R18', 'is_active' => true],
            ['nama' => 'Gedung 8 R19', 'is_active' => true],
            ['nama' => 'Gedung 8 R20', 'is_active' => true],
            ['nama' => 'Gedung 9 R21', 'is_active' => true],
            ['nama' => 'Gedung 9 R22', 'is_active' => true],
            ['nama' => 'Gedung 9 R23', 'is_active' => true],
            ['nama' => 'Lab Kom 1', 'is_active' => true],
            ['nama' => 'Lab Kom 2', 'is_active' => true],
            ['nama' => 'Lab Bahasa', 'is_active' => true],
            ['nama' => 'Lab OTKP/MPLB', 'is_active' => true],
            ['nama' => 'Bar F&B', 'is_active' => true],
            ['nama' => 'Hotel', 'is_active' => true],
            ['nama' => 'Lobby', 'is_active' => true],
        ];

        foreach ($lokasi as $loc) {
            Lokasi::create($loc);
        }
    }
}