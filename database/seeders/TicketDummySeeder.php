<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\KategoriSarana;
use App\Models\Lokasi;
use Carbon\Carbon;

class TicketDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data referensi
        $users = User::where('role', 'user')->get();
        $kategoris = KategoriSarana::all();
        $lokasis = Lokasi::all();

        if ($users->isEmpty() || $kategoris->isEmpty() || $lokasis->isEmpty()) {
            $this->command->error('Pastikan ada data User (role user), Kategori, dan Lokasi terlebih dahulu!');
            return;
        }

        // Status weights untuk distribusi yang natural
        $statusWeights = [
            'pending' => 15,    // 15%
            'verifikasi' => 20, // 20%
            'proses' => 25,     // 25%
            'selesai' => 30,    // 30%
            'ditolak' => 10,    // 10%
        ];

        // Deskripsi contoh untuk berbagai kategori
        $deskripsiExamples = [
            'kursi' => [
                'Kursi kelas dalam keadaan patah kakinya',
                'Kursi belajar rusak bagian sandaran',
                'Kursi goyang dan tidak stabil',
                'Kursi hilang bautnya sehingga berbahaya',
                'Kursi patah bagian dudukan'
            ],
            'meja' => [
                'Meja belajar bolong-bolong',
                'Meja tulis rusak bagian laci',
                'Meja goyang dan hampir roboh',
                'Meja coret-coret dan perlu dicat ulang',
                'Meja patah bagian kaki'
            ],
            'papan tulis' => [
                'Papan tulis putih sudah kusam tidak bisa dihapus',
                'Papan tulis hitam retak',
                'Papan tulis terlepas dari dinding',
                'Spidol papan tulis habis dan perlu penggantian'
            ],
            'proyektor' => [
                'Proyektor mati saat digunakan',
                'Proyektor layar buram dan tidak fokus',
                'Proyektor tidak bisa nyala sama sekali',
                'Remote proyektor rusak'
            ],
            'lemari' => [
                'Lemari kelas pintunya rusak tidak bisa ditutup',
                'Lemari guru bagian laci macet',
                'Lemari penyimpanan alat lab rusak',
                'Lemari buku raknya ambrol'
            ],
            'kipas' => [
                'Kipas angin tidak berputar',
                'Kipas angin berisik dan goyang',
                'Kipas angin mati total'
            ],
            'lampu' => [
                'Lampu kelas mati beberapa titik',
                'Lampu penerangan koridor padam',
                'Lampu LED berkedip-kedip'
            ],
            'toilet' => [
                'Toilet siswa mampet',
                'Kran air toilet bocor',
                'Pintu toilet rusak tidak bisa dikunci'
            ]
        ];

        // Tambahkan deskripsi umum
        $genericDescriptions = [
            'Perlu perbaikan segera karena mengganggu proses belajar mengajar',
            'Sudah rusak sejak 2 minggu yang lalu dan belum ada tindakan',
            'Mohon segera diperbaiki sebelum digunakan untuk ujian',
            'Kondisi sudah sangat memprihatinkan dan berbahaya bagi siswa',
            'Sudah dilaporkan sebelumnya namun belum ada tindak lanjut'
        ];

        $totalTickets = 0;
        $months = [5, 4, 3, 2, 1]; // 5 bulan kebelakang

        foreach ($months as $monthsAgo) {
            // Setiap bulan buat 15-30 tiket
            $ticketsThisMonth = rand(15, 30);
            $baseDate = Carbon::now()->subMonths($monthsAgo)->startOfMonth();
            $daysInMonth = $baseDate->daysInMonth;

            $this->command->info("Membuat {$ticketsThisMonth} tiket untuk bulan " . $baseDate->translatedFormat('F Y'));

            for ($i = 0; $i < $ticketsThisMonth; $i++) {
                // Random tanggal dalam bulan tersebut
                $randomDay = rand(1, $daysInMonth);
                $createdAt = Carbon::create(
                    $baseDate->year,
                    $baseDate->month,
                    $randomDay,
                    rand(7, 21),
                    rand(0, 59)
                );

                // Random status dengan weight
                $status = $this->getWeightedRandomStatus($statusWeights);

                // Untuk tiket selesai, updated_at = created_at + random days
                $updatedAt = clone $createdAt;
                if ($status == 'selesai') {
                    $updatedAt->addDays(rand(3, 14));
                } elseif ($status == 'ditolak') {
                    $updatedAt->addDays(rand(1, 5));
                } elseif ($status == 'proses') {
                    $updatedAt->addDays(rand(1, 7));
                } elseif ($status == 'verifikasi') {
                    $updatedAt->addDays(rand(0, 3));
                } else {
                    $updatedAt->addDays(rand(0, 2));
                }

                // Pilih user random
                $user = $users->random();

                // Pilih kategori random
                $kategori = $kategoris->random();

                // Pilih lokasi random
                $lokasi = $lokasis->random();

                // Generate deskripsi berdasarkan kategori
                $deskripsi = $this->generateDescription($kategori->nama, $deskripsiExamples, $genericDescriptions);

                // Random is_anonim (20% chance anonim)
                $isAnonim = rand(1, 100) <= 20;

                // Random foto (70% punya foto) - Gunakan foto_bukti
                $hasFoto = rand(1, 100) <= 70;
                $fotoBukti = $hasFoto ? 'dummy/ticket_' . rand(1, 10) . '.jpg' : null;

                // Buat tiket - Gunakan foto_bukti
                Ticket::create([
                    'no_tiket' => $this->generateNoTiket($createdAt, $totalTickets + $i),
                    'user_id' => $user->id,
                    'kategori_id' => $kategori->id,
                    'lokasi_id' => $lokasi->id,
                    'deskripsi' => $deskripsi,
                    'foto_bukti' => $fotoBukti,  // ← PASTIKAN INI foto_bukti
                    'status' => $status,
                    'is_anonim' => $isAnonim,
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt,
                ]);
            }

            $totalTickets += $ticketsThisMonth;
        }

        // Tambahan tiket untuk bulan ini (current month)
        $currentMonthTickets = rand(10, 20);
        $this->command->info("Membuat {$currentMonthTickets} tiket untuk bulan ini");

        for ($i = 0; $i < $currentMonthTickets; $i++) {
            $createdAt = Carbon::now()->subDays(rand(0, Carbon::now()->day))->setTime(rand(7, 21), rand(0, 59));
            $status = $this->getWeightedRandomStatus($statusWeights);

            $updatedAt = clone $createdAt;
            if ($status == 'selesai') {
                $updatedAt->addDays(rand(2, 10));
            } elseif ($status == 'ditolak') {
                $updatedAt->addDays(rand(1, 4));
            } elseif ($status == 'proses') {
                $updatedAt->addDays(rand(1, 5));
            }

            $user = $users->random();
            $kategori = $kategoris->random();
            $lokasi = $lokasis->random();
            $deskripsi = $this->generateDescription($kategori->nama, $deskripsiExamples, $genericDescriptions);
            $isAnonim = rand(1, 100) <= 20;
            $hasFoto = rand(1, 100) <= 70;
            $fotoBukti = $hasFoto ? 'dummy/ticket_' . rand(1, 10) . '.jpg' : null;

            // Buat tiket - Gunakan foto_bukti (bukan foto)
            Ticket::create([
                'no_tiket' => $this->generateNoTiket($createdAt, $totalTickets + $i),
                'user_id' => $user->id,
                'kategori_id' => $kategori->id,
                'lokasi_id' => $lokasi->id,
                'deskripsi' => $deskripsi,
                'foto_bukti' => $fotoBukti,  // ← PASTIKAN INI foto_bukti
                'status' => $status,
                'is_anonim' => $isAnonim,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }

        $this->command->info("Total " . ($totalTickets + $currentMonthTickets) . " tiket dummy berhasil dibuat!");
    }

    /**
     * Generate nomor tiket berdasarkan tanggal
     */
    private function generateNoTiket(Carbon $date, $counter): string
    {
        return 'TCK-' . $date->format('Ymd') . '-' . str_pad($counter % 1000, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Get weighted random status
     */
    private function getWeightedRandomStatus(array $weights): string
    {
        $rand = mt_rand(1, 100);
        $cumulative = 0;

        foreach ($weights as $status => $weight) {
            $cumulative += $weight;
            if ($rand <= $cumulative) {
                return $status;
            }
        }

        return 'pending';
    }

    /**
     * Generate deskripsi berdasarkan kategori
     */
    private function generateDescription($kategoriNama, $deskripsiExamples, $genericDescriptions): string
    {
        // Cari kata kunci dalam nama kategori
        $matchedKey = null;
        foreach ($deskripsiExamples as $key => $examples) {
            if (stripos($kategoriNama, $key) !== false) {
                $matchedKey = $key;
                break;
            }
        }

        if ($matchedKey && !empty($deskripsiExamples[$matchedKey])) {
            $specificDesc = $deskripsiExamples[$matchedKey][array_rand($deskripsiExamples[$matchedKey])];
            $genericDesc = $genericDescriptions[array_rand($genericDescriptions)];

            // 70% menggunakan spesifik + generik, 30% hanya spesifik
            if (rand(1, 100) <= 70) {
                return $specificDesc . '. ' . $genericDesc;
            }
            return $specificDesc;
        }

        // Jika tidak ada kecocokan, gunakan deskripsi generik dengan kategori
        $generic = $genericDescriptions[array_rand($genericDescriptions)];
        return "Kerusakan pada {$kategoriNama}. " . $generic;
    }
}
