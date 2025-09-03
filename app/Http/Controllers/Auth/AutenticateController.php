<?php

namespace App\Http\Controllers\Auth;

use App\Clases\Auth\AuthCentralController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuarios\CentralUser;
use Illuminate\Container\Attributes\Auth;
use Laravel\WorkOS\Http\Requests\AuthKitAuthenticationRequest;

class AutenticateController extends Controller
{
    /**
     * Handle WorkOS authentication callback.
     */
    public function authenticate(AuthKitAuthenticationRequest $request)
    {
        $createUsing = fn($user) => $this->createCentralUser($user);
        $updateUsing = fn($existingUser, $user) => $this->updateCentralUser($existingUser, $user);
       
        $request->authenticate(
            createUsing: $createUsing,
            updateUsing: $updateUsing
        );

        // redireccionar a la ruta redirect
        return redirect()->route('redirect');
    }

    /**
     * Create a new CentralUser from WorkOS user data.
     */
    private function createCentralUser($user)
    {
        $central = CentralUser::firstOrCreate(
            ['email' => $user->email],
            [
                'name' => $user->firstName . ' ' . $user->lastName,
                'email_verified_at' => now(),
                'workos_id' => $user->id,
                'avatar' => $user->avatar ?? '',
            ]
        );

        $user = User::where('email', $central->email)->first();

        return $user ?: $central;
    }
    /**
     * Update an existing CentralUser with WorkOS user data.
     */
    private function updateCentralUser($existingUser, $user)
    {
        CentralUser::where('email', $existingUser->email)->update([
            'name' => $user->firstName . ' ' . $user->lastName,
            'email' => $user->email,
            'avatar' => $user->avatar ?? '',
        ]);

        return $existingUser;
    }
}
