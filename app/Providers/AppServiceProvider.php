<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Use View::composer on all admin views or globally
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $view->with('unreadCount', \App\Models\Inquiry::where('status', 'unread')->count());
        });
    }
}
