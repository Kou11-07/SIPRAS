<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // TAMBAHKAN INI

class AuthWeb
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('AUTHWEB MIDDLEWARE - BEFORE CHECK', [
            'url' => $request->url(),
            'auth_check' => Auth::check(), // CEK AUTH, BUKAN SESSION
            'user' => Auth::user() ? Auth::user()->name : null,
            'session_id' => session()->getId(),
        ]);

        // CEK PAKAI AUTH, BUKAN SESSION MANUAL
        if (!Auth::check()) {
            Log::warning('AUTHWEB MIDDLEWARE - NO USER, REDIRECT TO LOGIN');

            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        Log::info('AUTHWEB MIDDLEWARE - USER FOUND, ALLOW ACCESS', [
            'user' => Auth::user()->name,
            'url' => $request->url()
        ]);

        return $next($request);
    }
}
