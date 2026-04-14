<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TiketController extends Controller
{
    public function index(Request $request)
    {
        // Cek login admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses hanya untuk admin');
        }

        // Query dasar - HANYA tiket yang belum selesai/ditolak
        $query = Ticket::with(['user', 'lokasi', 'kategori'])
            ->whereNotIn('status', ['selesai', 'ditolak']); // Perubahan: exclude status final

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_tiket', 'like', "%{$search}%")
                    ->orWhere('nama_pengirim', 'like', "%{$search}%")
                    ->orWhere('nisn_pengirim', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('username', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Urutkan dan paginasi
        $tickets = $query->orderBy('created_at', 'desc')->paginate(5);

        // Statistik untuk badge - HANYA tiket aktif
        $totalMenunggu = Ticket::where('status', 'pending')->count();
        $totalDiproses = Ticket::where('status', 'proses')->count();
        $totalDiverifikasi = Ticket::where('status', 'verifikasi')->count(); // Tetap untuk statistik

        return view('admin.tiket', compact(
            'tickets',
            'totalMenunggu',
            'totalDiproses',
            'totalDiverifikasi'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,verifikasi,proses,selesai,ditolak',
            'feedback' => 'required|string|max:1000', // Tambahkan required
        ], [
            'feedback.required' => 'Feedback wajib diisi sebelum mengubah status tiket!'
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status;

        // Cek apakah tiket sudah dalam status final
        if (in_array($oldStatus, ['selesai', 'ditolak'])) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket sudah dalam status final dan tidak dapat diubah lagi'
            ], 400);
        }

        DB::beginTransaction();

        try {
            $ticket->status = $request->status;

            // SIMPAN FEEDBACK KE KOLOM TICKET
            if ($request->has('feedback') && !empty($request->feedback)) {
                $ticket->feedback = $request->feedback;
            }

            // Update timestamp sesuai status
            if ($request->status == 'proses' && !$ticket->diproses_at) {
                $ticket->diproses_at = now();
            }
            if ($request->status == 'selesai') {
                $ticket->selesai_at = now();
            }
            if ($request->status == 'ditolak') {
                $ticket->selesai_at = now();
            }

            $ticket->save();

            // Catat history dengan feedback
            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'status' => $request->status,
                'catatan' => $request->feedback, // feedback wajib diisi
                'changed_by' => Auth::id()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate',
                'new_status' => $request->status,
                'feedback' => $request->feedback,
                'is_final' => in_array($request->status, ['selesai', 'ditolak'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $ticket = Ticket::with(['user', 'lokasi', 'kategori', 'histories.changedBy'])
            ->findOrFail($id);

        return response()->json($ticket);
    }

    public function showRiwayat($id)
    {
        $ticket = Ticket::with(['user', 'lokasi', 'kategori', 'histories.changedBy'])
            ->whereIn('status', ['selesai', 'ditolak']) // Hanya tiket yang sudah final
            ->findOrFail($id);

        return view('admin.riwayat-detail', compact('ticket'));
    }

    public function getTicketData($id)
    {
        $ticket = Ticket::with(['user', 'lokasi', 'kategori', 'histories.changedBy'])
            ->findOrFail($id);

        return response()->json([
            'ticket' => $ticket,
            'feedback' => $ticket->feedback
        ]);
    }
}
