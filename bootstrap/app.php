<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__ . '/../routes/console.php',
        then: function () {
            //Load admin FIRST
            Route::middleware('web')
                ->prefix('backend')
                ->group(base_path('routes/admin.php'));
            //Then load web routes
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
