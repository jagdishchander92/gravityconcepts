<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Mail\Transport\SendGridTransport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use SendGrid;
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
        Paginator::useBootstrap();
        Mail::extend('sendgrid', function () {
            $client = new SendGrid(env('SENDGRID_API_KEY'));

            return new SendGridTransport($client);
        });
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
