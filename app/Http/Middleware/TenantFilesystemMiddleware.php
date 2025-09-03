<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

class TenantFilesystemMiddleware
{
    public function handle($request, Closure $next)
    {
        // Solo aplicar tenancy si NO es dominio central
        if (!in_array($request->getHost(), config('tenancy.central_domains'))) {
            app(InitializeTenancyByDomain::class)->handle($request, function () {});
        }

        return $next($request);
    }
}
