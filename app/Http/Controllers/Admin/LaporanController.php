<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function cetak(Request $request)
    {
        // FILTER KATEGORI (opsional)
        $kategoriId = $request->kategori_id;

        $query = Ticket::query();

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        // SUMMARY
        $total = $query->count();
        $totalSelesai = (clone $query)->where('status', 'selesai')->count();
        $totalDitolak = (clone $query)->where('status', 'ditolak')->count();
        $bulanIni = (clone $query)->whereMonth('created_at', now()->month)->count();

        // DATA KATEGORI
        $kategoriData = Ticket::select('kategori_id', DB::raw('count(*) as total'))
            ->with('kategori')
            ->groupBy('kategori_id')
            ->get();

        // PDF
        $pdf = Pdf::loadView('admin.pdf', [
            'total' => $total,
            'totalSelesai' => $totalSelesai,
            'totalDitolak' => $totalDitolak,
            'bulanIni' => $bulanIni,
            'kategoriData' => $kategoriData,
        ]);

        return $pdf->download('laporan-pengaduan.pdf');
    }
}
