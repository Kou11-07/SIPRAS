<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $kelas = [
            ['nama_kelas' => 'X RPL 1', 'tingkat' => 'X', 'jurusan' => 'RPL'],
            ['nama_kelas' => 'X RPL 2', 'tingkat' => 'X', 'jurusan' => 'RPL'],
            ['nama_kelas' => 'X RPL 3', 'tingkat' => 'X', 'jurusan' => 'RPL'],
            ['nama_kelas' => 'XI RPL 1', 'tingkat' => 'XI', 'jurusan' => 'RPL'],
            ['nama_kelas' => 'XI RPL 2', 'tingkat' => 'XI', 'jurusan' => 'RPL'],
            ['nama_kelas' => 'XI RPL 3', 'tingkat' => 'XI', 'jurusan' => 'RPL'],
            ['nama_kelas' => 'XII RPL 1', 'tingkat' => 'XII', 'jurusan' => 'RPL'],
            ['nama_kelas' => 'XII RPL 2', 'tingkat' => 'XII', 'jurusan' => 'RPL'],
            ['nama_kelas' => 'XII RPL 3', 'tingkat' => 'XII', 'jurusan' => 'RPL'],
            ['nama_kelas' => 'X TKR 1', 'tingkat' => 'X', 'jurusan' => 'TKR'],
            ['nama_kelas' => 'X TKR 2', 'tingkat' => 'X', 'jurusan' => 'TKR'],
            ['nama_kelas' => 'X TK 3', 'tingkat' => 'X', 'jurusan' => 'TKR'],
            ['nama_kelas' => 'XI TKR 1', 'tingkat' => 'XI', 'jurusan' => 'TKR'],
            ['nama_kelas' => 'XI TKR 2', 'tingkat' => 'XI', 'jurusan' => 'TKR'],
            ['nama_kelas' => 'XI TKR 3', 'tingkat' => 'XI', 'jurusan' => 'TKR'],
            ['nama_kelas' => 'XII TKR 1', 'tingkat' => 'XII', 'jurusan' => 'TKR'],
            ['nama_kelas' => 'XII TKR 2', 'tingkat' => 'XII', 'jurusan' => 'TKR'],
            ['nama_kelas' => 'XII TKR 3', 'tingkat' => 'XII', 'jurusan' => 'TKR'],
            ['nama_kelas' => 'X PH 1', 'tingkat' => 'X', 'jurusan' => 'PH'],
            ['nama_kelas' => 'X PH 2', 'tingkat' => 'X', 'jurusan' => 'PH'],
            ['nama_kelas' => 'X PH 3', 'tingkat' => 'X', 'jurusan' => 'PH'],
            ['nama_kelas' => 'XI PH 1', 'tingkat' => 'XI', 'jurusan' => 'PH'],
            ['nama_kelas' => 'XI PH 2', 'tingkat' => 'XI', 'jurusan' => 'PH'],
            ['nama_kelas' => 'XI PH 3', 'tingkat' => 'XI', 'jurusan' => 'PH'],
            ['nama_kelas' => 'XII PH 1', 'tingkat' => 'XII', 'jurusan' => 'PH'],
            ['nama_kelas' => 'XII PH 2', 'tingkat' => 'XII', 'jurusan' => 'PH'],
            ['nama_kelas' => 'XII PH 3', 'tingkat' => 'XII', 'jurusan' => 'PH'],
            ['nama_kelas' => 'X MPLB 1', 'tingkat' => 'X', 'jurusan' => 'MPLB'],
            ['nama_kelas' => 'X MPLB 2', 'tingkat' => 'X', 'jurusan' => 'MPLB'],
            ['nama_kelas' => 'X MPLB 3', 'tingkat' => 'X', 'jurusan' => 'MPLB'],
            ['nama_kelas' => 'XI MPLB 1', 'tingkat' => 'XI', 'jurusan' => 'MPLB'],
            ['nama_kelas' => 'XI MPLB 2', 'tingkat' => 'XI', 'jurusan' => 'MPLB'],
            ['nama_kelas' => 'XI MPLB 3', 'tingkat' => 'XI', 'jurusan' => 'MPLB'],
            ['nama_kelas' => 'XII MPLB 1', 'tingkat' => 'XII', 'jurusan' => 'MPLB'],
            ['nama_kelas' => 'XII MPLB 2', 'tingkat' => 'XII', 'jurusan' => 'MPLB'],
            ['nama_kelas' => 'XII MPLB 3', 'tingkat' => 'XII', 'jurusan' => 'MPLB'],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }
    }
}