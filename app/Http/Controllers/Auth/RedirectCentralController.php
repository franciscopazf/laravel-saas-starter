<?php

namespace App\Http\Controllers\Auth;

use App\Clases\Auth\AuthCentralController;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class RedirectCentralController extends Controller
{
    //

    public function redirect(Request $request)
    {
        // redireccion desde el dominio central :)

       return AuthCentralController::make()->runToCentral();
    }
}
