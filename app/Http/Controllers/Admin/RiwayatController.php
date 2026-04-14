<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\KategoriSarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // Cek login admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses hanya untuk admin');
        }

        // Ambil data kategori untuk dropdown filter
        $kategori = KategoriSarana::all();

        // Query untuk tiket yang sudah selesai atau ditolak
        $query = Ticket::with(['user', 'lokasi', 'kategori'])
            ->whereIn('status', ['selesai', 'ditolak']);

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_tiket', 'like', "%{$search}%")
                    ->orWhere('nama_pengirim', 'like', "%{$search}%")
                    ->orWhere('nisn_pengirim', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Urutkan dan paginasi
        $riwayat = $query->orderBy('updated_at', 'desc')->paginate(10);

        // Statistik
        $totalSelesai = Ticket::where('status', 'selesai')->count();
        $bulanIni = Ticket::where('status', 'selesai')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $mingguIni = Ticket::where('status', 'selesai')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        return view('admin.riwayat', compact(
            'riwayat',
            'totalSelesai',
            'bulanIni',
            'mingguIni',
            'kategori'
        ));
    }

    public function show($id)
    {
        // Cek login admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses hanya untuk admin');
        }

        // Ambil tiket dengan status selesai atau ditolak beserta relasinya
        $ticket = Ticket::with(['user', 'lokasi', 'kategori', 'histories.changedBy'])
            ->whereIn('status', ['selesai', 'ditolak'])
            ->findOrFail($id);

        return view('admin.riwayat-detail', compact('ticket'));
    }
}
