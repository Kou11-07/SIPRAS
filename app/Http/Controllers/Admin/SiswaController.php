<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses hanya untuk admin');
        }

        $query = User::where('role', 'user');

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'aktif') {
                $query->where('is_active', true);
            } elseif ($request->status == 'nonaktif') {
                $query->where('is_active', false);
            }
        }

        // Filter berdasarkan kelas - GUNAKAN KOLOM 'kelas' LANGSUNG
        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('kelas', $request->kelas);
        }

        $siswa = $query->orderBy('username', 'asc')->paginate(10);

        $totalSiswa = User::where('role', 'user')->count();
        $aktif = User::where('role', 'user')->where('is_active', true)->count();
        $nonaktif = User::where('role', 'user')->where('is_active', false)->count();

        // Ambil data kelas dari tabel kelas untuk dropdown
        $daftarKelas = Kelas::where('is_active', true)
            ->orderBy('nama_kelas')
            ->get();

        return view('admin.siswa', compact(
            'siswa',
            'totalSiswa',
            'aktif',
            'nonaktif',
            'daftarKelas'
        ));
    }

    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses hanya untuk admin');
        }

        // Ambil semua kelas yang aktif
        $kelas = Kelas::where('is_active', true)->orderBy('nama_kelas')->get();

        return view('admin.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        // Di controller admin/siswa (store/update)
        $request->validate([
            'nisn' => 'required|string|size:10|unique:users,nisn,' . ($siswa->id ?? ''),
            'username' => 'required|string|max:40|unique:users,username,' . ($siswa->id ?? ''),
            'tanggal_lahir' => 'required|date',
            'kelas' => 'required|exists:kelas,id',
            'phone' => 'nullable|string|max:13|regex:/^[0-9]+$/',
        ]);

        // Ambil data kelas berdasarkan ID
        $kelas = Kelas::findOrFail($request->kelas);

        // PASSWORD OTOMATIS DARI TANGGAL LAHIR (format: Ymd)
        $autoPassword = date('Ymd', strtotime($request->tanggal_lahir));

        User::create([
            'nisn' => $request->nisn,
            'username' => $request->username,
            'tanggal_lahir' => $request->tanggal_lahir,
            'phone' => $request->phone,
            'kelas' => $kelas->nama_kelas, // Simpan nama_kelas ke field kelas (untuk kompatibilitas)
            'kelas_id' => $kelas->id, // Simpan ID kelas
            'password' => Hash::make($autoPassword),
            'role' => 'user',
            'is_active' => true
        ]);

        return redirect()->route('admin.siswa')
            ->with('success', 'Siswa berhasil ditambahkan. Password = Tanggal Lahir (YYYYMMDD)');
    }

    public function edit($id)
    {
        $siswa = User::where('role', 'user')->findOrFail($id);

        // Ambil semua kelas yang aktif
        $kelas = Kelas::where('is_active', true)->orderBy('nama_kelas')->get();

        // Cari kelas_id yang sesuai dengan kelas siswa
        $selectedKelas = Kelas::where('nama_kelas', $siswa->kelas)->first();

        return view('admin.create', compact('siswa', 'kelas', 'selectedKelas'));
    }

    public function update(Request $request, $id)
    {
        $siswa = User::where('role', 'user')->findOrFail($id);

        $request->validate([
            'nisn' => 'required|string|unique:users,nisn,' . $id,
            'username' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'phone' => 'nullable|string|max:20',
            'kelas' => 'required|exists:kelas,id',
        ]);

        // Ambil data kelas berdasarkan ID
        $kelas = Kelas::findOrFail($request->kelas);

        $data = [
            'nisn' => $request->nisn,
            'username' => $request->username,
            'tanggal_lahir' => $request->tanggal_lahir,
            'phone' => $request->phone,
            'kelas' => $kelas->nama_kelas,
            'kelas_id' => $kelas->id,
        ];

        // Jika admin ingin mereset password (opsional)
        if ($request->filled('reset_password')) {
            $data['password'] = Hash::make(date('Ymd', strtotime($request->tanggal_lahir)));
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa')
            ->with('success', 'Siswa berhasil diperbarui');
    }

    public function toggleActive($id)
    {
        $siswa = User::where('role', 'user')->findOrFail($id);
        $siswa->is_active = !$siswa->is_active;
        $siswa->save();

        $status = $siswa->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.siswa')
            ->with('success', "Siswa berhasil {$status}");
    }

    public function destroy($id)
    {
        $siswa = User::where('role', 'user')->findOrFail($id);

        if ($siswa->tickets()->count() > 0) {
            $siswa->is_active = false;
            $siswa->save();

            return redirect()->route('admin.siswa')
                ->with('warning', 'Siswa memiliki riwayat tiket, hanya dinonaktifkan');
        }

        $siswa->delete();

        return redirect()->route('admin.siswa')
            ->with('success', 'Siswa berhasil dihapus');
    }
}
