<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        // Validasi berdasarkan jenis login
        if ($request->has('username')) {
            // Login Admin
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string'
            ]);

            $user = User::authenticateAdmin($request->username, $request->password);

            if (!$user) {
                return back()->withErrors(['login' => 'Username atau password salah']);
            }

            if (!$user->is_active) {
                return back()->withErrors(['login' => 'Akun tidak aktif']);
            }

            Auth::login($user, true);
            return redirect()->route('admin.dashboard');
        } else {
            // Login User
            $request->validate([
                'nisn' => 'required|string',
                'tanggal_lahir' => 'required|date'
            ]);

            $user = User::authenticateUser($request->nisn, $request->tanggal_lahir);

            if (!$user) {
                return back()->withErrors(['login' => 'NISN atau Tanggal lahir tidak sesuai']);
            }

            if (!$user->is_active) {
                return back()->withErrors(['login' => 'Akun tidak aktif']);
            }

            Auth::login($user, true);
            return redirect()->route('user.form');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
