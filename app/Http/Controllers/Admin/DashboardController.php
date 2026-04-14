<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Models\KategoriSarana;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek login admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses hanya untuk admin');
        }

        // Statistik Tiket
        $totalTiket = Ticket::count();
        $menunggu = Ticket::where('status', Ticket::STATUS_PENDING)->count();
        $diproses = Ticket::where('status', Ticket::STATUS_PROSES)->count();
        $selesai = Ticket::where('status', Ticket::STATUS_SELESAI)->count();
        $ditolak = Ticket::where('status', Ticket::STATUS_DITOLAK)->count();

        // Tiket per bulan (untuk chart)
        $tikertPerBulan = Ticket::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->pluck('total', 'bulan')
            ->toArray();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $tikertPerBulan[$i] ?? 0;
        }

        // Tiket terbaru
        $tiketTerbaru = Ticket::with(['user', 'lokasi', 'kategori'])
            ->whereNotIn('status', ['selesai', 'ditolak'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // ========== LIST ASPIRASI KESELURUHAN ==========

        // 1. Per Tanggal (SEMUA TANGGAL - tanpa batasan)
        $perTanggal = Ticket::select(
            DB::raw('DATE(created_at) as tanggal'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc') // Urut dari tanggal terbaru
            ->get();

        // 2. Per Bulan (SEMUA BULAN - tanpa batasan)
        $perBulan = Ticket::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->get();

        // 3. Per Siswa (top 5 siswa paling banyak lapor)
        $perSiswa = User::where('role', 'user')
            ->withCount('tickets')
            ->having('tickets_count', '>', 0)
            ->orderBy('tickets_count', 'desc')
            ->limit(5)
            ->get();

        // 4. Per Kategori
        $perKategori = KategoriSarana::withCount('tickets')
            ->having('tickets_count', '>', 0)
            ->orderBy('tickets_count', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalTiket',
            'menunggu',
            'diproses',
            'selesai',
            'ditolak',
            'chartData',
            'tiketTerbaru',
            'perTanggal',
            'perBulan',
            'perSiswa',
            'perKategori'
        ));
    }
}
