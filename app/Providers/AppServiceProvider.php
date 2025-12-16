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
        \Illuminate\Support\Facades\Gate::define('edit-event', function ($user) {
            // allows any authenticated user for now, or restrictive logic
            return $user->email === 'admin@example.com';
        });

        \Illuminate\Support\Facades\Gate::define('delete-event', function ($user) {
            return $user->email === 'admin@example.com';
        });
    }
}
