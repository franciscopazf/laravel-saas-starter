<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'permission' => Spatie\Permission\Middleware\PermissionMiddleware::class, // cloned from Spatie\Permission\Middleware
            'universal' => \App\Http\Middleware\UniversalMiddleware::class,
            'tenant.if.not.central' => \App\Http\Middleware\TenantFilesystemMiddleware::class,
            'guest' => \App\Http\Middleware\OnlyGuestAllowedMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
