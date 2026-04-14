<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\KategoriSarana;
use App\Models\Kelas;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $lokasi = Lokasi::where('is_active', true)->get();
        $kategori = KategoriSarana::where('is_active', true)->get();
        $kelas = Kelas::where('is_active', true)->get();
        $totalLaporan = Ticket::count();

        // Ambil user yang sedang login
        $user = Auth::user();

        return view('user.form', compact('lokasi', 'kategori', 'kelas', 'totalLaporan', 'user'));
    }

    public function store(Request $request)
    {
        // Validasi dasar
        $rules = [
            'deskripsi' => 'required|min:10',
            'foto' => 'required|image|max:10240',
            'kontak' => 'nullable|string|max:255'
        ];

        // Validasi untuk Lokasi
        if ($request->lokasi_id === 'lainnya') {
            $rules['lokasi_lainnya'] = 'required|string|max:255';
        } else {
            $rules['lokasi_id'] = 'required|exists:lokasi,id';
        }

        // Validasi untuk Kategori
        if ($request->kategori_id === 'lainnya') {
            $rules['kategori_lainnya'] = 'required|string|max:255';
        } else {
            $rules['kategori_id'] = 'required|exists:kategori_sarana,id';
        }

        $request->validate($rules);

        $user = Auth::user();
        $noTiket = 'TCK' . date('Ymd') . rand(1000, 9999);

        DB::beginTransaction();

        try {
            // Handle Lokasi
            if ($request->lokasi_id === 'lainnya') {
                // Cek apakah sudah ada lokasi dengan nama yang sama
                $lokasi = Lokasi::firstOrCreate(
                    ['nama' => $request->lokasi_lainnya],
                    ['is_active' => true]
                );
                $lokasi_id = $lokasi->id;
            } else {
                $lokasi_id = $request->lokasi_id;
            }

            // Handle Kategori
            if ($request->kategori_id === 'lainnya') {
                // Cek apakah sudah ada kategori dengan nama yang sama
                $kategori = KategoriSarana::firstOrCreate(
                    ['nama' => $request->kategori_lainnya],
                    ['is_active' => true]
                );
                $kategori_id = $kategori->id;
            } else {
                $kategori_id = $request->kategori_id;
            }

            // Simpan ke database
            $ticket = new Ticket();
            $ticket->no_tiket = $noTiket;
            $ticket->user_id = $user->id;
            $ticket->nama_pengirim = $request->has('is_anonim') ? 'Anonim' : $user->username;
            $ticket->nisn_pengirim = $request->has('is_anonim') ? 'ANONIM' : $user->nisn;
            $ticket->kelas_id = $user->kelas_id;
            // HAPUS BARIS INI -> $ticket->kelas_pengirim = ...
            $ticket->lokasi_id = $lokasi_id;
            $ticket->kategori_id = $kategori_id;
            $ticket->deskripsi = $request->deskripsi;
            $ticket->is_anonim = $request->has('is_anonim') ? true : false;
            $ticket->status = 'pending';
            $ticket->kontak = $user->phone ?? $user->email ?? '-';

            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('tickets', 'public');
                $ticket->foto_bukti = $path;
            }

            $ticket->save();

            // UPDATE NOMOR HP DI TABEL USER JIKA BERBEDA
            // Pastikan menggunakan model User yang benar
            if ($user->phone != $request->kontak) {
                $userModel = \App\Models\User::find($user->id);
                if ($userModel) {
                    $userModel->phone = $request->kontak;
                    $userModel->save();
                }
            }

            DB::commit();

            return redirect()->route('user.histori')
                ->with('success', 'Laporan berhasil dikirim! No. Tiket: ' . $noTiket);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
