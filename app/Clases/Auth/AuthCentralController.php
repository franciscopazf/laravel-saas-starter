<?php

namespace App\Clases\Auth;

use App\Models\Tenants\Tenant;
use App\Models\User;
use App\Models\Usuarios\CentralUser;

class AuthCentralController
{
    private ?User $user;
    private CentralUser $centralUser;

    // Your controller code here


    public function __construct(?User $user = null)
    {
        // si el usuario es null obtener el autenticado 
        if ($user === null) {
            $user = auth()->user();
        }
        $this->user = $user;
        $this->centralUser = CentralUser::where('email', $user->email)->first();
    }


    public static function make(?User $user = null): self
    {
        return new self($user);
    }


    // 
    public function runToCentral()
    {
        // si el usuario tiene el permiso de "acceder aplicacion central" significa que tiene algo que hacer 
        // en la aplicacion central por lo tanto es un administrador o delegado, en ambos modos se debe dejar 
        // pasar al dashboard central.
        // como es administrativo se asume que quiere ver informacion central, el podra hacer la redireccion manual.
        // y ademas el usuario tiene el permiso de acceder-dashboard_central
        if ($this->user->is_central_user && $this->user->hasPermissionTo('acceder-dashboard_central')) {
            return redirect()->route('dashboard_central');
        }

        // si el usuario tiene solamente un tenant significa que pertenece solamnete a ese tenant por lo tanto hacer la redireccion a el.
        if ($this->centralUser->hasOnlyOneTenant()) {
            return $this->centralUser->tenants()->first()->redirectToDomain();
        }

        // si el usuario llega hasta aca significa que tiene mas de un tenant asi que se debe validar si
        // tiene un id de tenat seleccionado para ese caso se redirecciona,
        // if ($this->user->hasSelectedTenant()) {
        return redirect()->route('seleccionartenant_uFN');
        // }


        // si llega hasta aca se asume que tiene mas de un tenant y que ademas no ha seleccionado ninguno por defecto.
        // por lo tanto se le debe mostrar una lista de tenants para que seleccione uno.
        // return $this->showTenantSelection();
    }




    // redirecciona a la aplicaicon o dominio central
    public function redirectToCentral()
    {
        return redirect()->route('central.login');
    }
}
