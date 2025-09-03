<?php

use App\Livewire\Dashboard\Home\Home;
use Illuminate\Support\Facades\Route;
use Laravel\WorkOS\Http\Middleware\ValidateSessionWithWorkOS;
use Rk\RoutingKit\Entities\RkRoute;

RkRoute::registerRoutes();


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {

            // si el usuario esta logeado redireccionar a dashboard
            // si no esta logeado redireccionar al dominio central

            // if (!auth()->check()) {
            //     return redirect()->to(config('tenancy.central_domains')[0]);
            // }

            return view('welcome');
        });
    });
}

// routes/web.php, api.php or any other central route files you have


Route::middleware([
    'auth',
    ValidateSessionWithWorkOS::class,
])->group(function () {
    //Route::get('dashboard', Home::class)->name('dashboard');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
