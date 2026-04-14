<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->timestamp('verifikasi_at')->nullable()->after('diproses_at');
            $table->foreignId('verified_by')->nullable()->constrained('users')->after('verifikasi_at');
            $table->text('alasan_verifikasi')->nullable()->after('verified_by'); // Kenapa perlu verifikasi
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['verifikasi_at', 'verified_by', 'alasan_verifikasi']);
        });
    }
};