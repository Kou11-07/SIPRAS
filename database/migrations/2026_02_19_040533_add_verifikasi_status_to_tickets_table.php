<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah enum status untuk menambah 'verifikasi'
        DB::statement("ALTER TABLE tickets MODIFY COLUMN status ENUM('pending', 'verifikasi', 'proses', 'selesai', 'ditolak') DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Kembalikan ke enum lama
        DB::statement("ALTER TABLE tickets MODIFY COLUMN status ENUM('pending', 'proses', 'selesai', 'ditolak') DEFAULT 'pending'");
    }
};