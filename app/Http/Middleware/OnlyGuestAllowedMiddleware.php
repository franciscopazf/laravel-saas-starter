<?php

namespace App\Http\Middleware;

use App\Clases\Auth\AuthCentralController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyGuestAllowedMiddleware
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // dd('estoy en el middleware OnlyGuestAllowedMiddleware');
                //  dd($request->getHost());
                if (in_array($request->getHost(), config('tenancy.central_domains'))) {
                    // redireccionar a la ruta redirect para redireccionar
                    return redirect()->route('redirect');
                } else {
                    // dd('estoy en el middleware OnlyGuestAllowedMiddleware - no es central');
                    // redireccionar a la ruta dashboard de la comunidad
                    //   return redirect()->route('dashboard');
                }
                //   return redirect(Auth::user()->getRedirectRoute()); 
            }
            //    dd('no estoy autenticado');
        }

        return $next($request);
    }
}
