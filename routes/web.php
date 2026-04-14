<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\FormController;
use App\Http\Controllers\User\HistoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\RiwayatController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\User\TentangController;
use App\Http\Controllers\Admin\LaporanController;


// ============= PUBLIC ROUTES =============
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ============= USER ROUTES =============
Route::middleware(['auth.web', 'user.active'])->prefix('user')->name('user.')->group(function () {
    Route::get('/form', [FormController::class, 'index'])->name('form');
    Route::post('/tickets', [FormController::class, 'store'])->name('tickets.store');
    Route::get('/histori', [HistoriController::class, 'index'])->name('histori');
    Route::get('/tickets/{id}', [HistoriController::class, 'show'])->name('tickets.detail');
    Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
});

// ============= ADMIN ROUTES =============
// Di web.php bagian admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tiket', [TiketController::class, 'index'])->name('tiket');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::get('/riwayat/{id}', [RiwayatController::class, 'show'])->name('riwayat.show');

    // Routes untuk manajemen siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::put('/siswa/{id}/toggle-active', [SiswaController::class, 'toggleActive'])->name('siswa.toggle-active');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    // Di dalam group admin, ubah route PDF menjadi:
    Route::get('/laporan/cetak-pdf', [LaporanController::class, 'cetak'])->name('laporan.pdf');

    // API routes
    Route::put('/tiket/{id}/status', [TiketController::class, 'updateStatus'])->name('tiket.status');
    Route::get('/tiket/{id}', [TiketController::class, 'show'])->name('tiket.detail');
    Route::get('/tiket/{id}/data', [TiketController::class, 'getTicketData'])->name('tiket.data'); // tambahkan ini jika perlu
});
