<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas'); // contoh: "XII RPL 1"
            $table->string('tingkat')->nullable(); // X, XI, XII
            $table->string('jurusan')->nullable(); // RPL, TKJ, AKL, dll
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tambahkan kolom kelas_id ke tabel tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('kelas_id')->nullable()->after('nisn_pengirim')->constrained()->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
        Schema::dropIfExists('kelas');
    }
};