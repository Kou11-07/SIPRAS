<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticket;

class TicketPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id || $user->role === 'admin';
    }

    public function create(User $user)
    {
        return $user->is_active;
    }

    public function update(User $user, Ticket $ticket)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Ticket $ticket)
    {
        return $user->role === 'admin';
    }
}