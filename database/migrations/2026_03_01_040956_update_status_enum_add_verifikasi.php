<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update ENUM di tabel tickets
        DB::statement("ALTER TABLE tickets MODIFY COLUMN status ENUM('pending', 'verifikasi', 'proses', 'selesai', 'ditolak') DEFAULT 'pending'");
        
        // Update ENUM di tabel ticket_histories
        DB::statement("ALTER TABLE ticket_histories MODIFY COLUMN status ENUM('pending', 'verifikasi', 'proses', 'selesai', 'ditolak') NOT NULL");
    }

    public function down(): void
    {
        // Kembalikan ke ENUM lama
        DB::statement("ALTER TABLE tickets MODIFY COLUMN status ENUM('pending', 'proses', 'selesai', 'ditolak') DEFAULT 'pending'");
        DB::statement("ALTER TABLE ticket_histories MODIFY COLUMN status ENUM('pending', 'proses', 'selesai', 'ditolak') NOT NULL");
    }
};