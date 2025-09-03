<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
// use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::group([
    'middleware' => [
        'web',
        // InitializeTenancyBySubdomain::class,
        InitializeTenancyByDomain::class,
        PreventAccessFromCentralDomains::class
    ],
], function () {
    Route::get('/', function () {
        // redireccion pero tambien podria ser un index html que la comunidad active :(
        // para que pueda mostrar datos de ella.
        if (!auth()->check())
            return redirect()->to(env('APP_URL'));
        return redirect()->route('dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
