<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\BrevoTransport;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Your existing HTTPS fix
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Brevo API transport
        Mail::extend('brevo', function (array $config = []) {
            return new BrevoTransport(
                apiKey: config('services.brevo.key')
            );
        });
    }
}