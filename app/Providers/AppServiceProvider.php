<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// TAMBAHKAN INI
use Illuminate\Support\Facades\Gate;
use App\Models\Ticket;
use App\Policies\TicketPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // TARUH DI SINI - di dalam method boot()
        
        // Daftarkan policy secara manual
        Gate::policy(Ticket::class, TicketPolicy::class);
        
    }
}