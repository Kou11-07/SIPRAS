<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class HistoriController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $tickets = Ticket::with(['lokasi', 'kategori'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.histori', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with(['lokasi', 'kategori', 'histories'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$ticket) {
            return redirect()->route('user.histori')
                ->with('error', 'Tiket tidak ditemukan');
        }

        return view('user.detail-tiket', compact('ticket'));
    }
}