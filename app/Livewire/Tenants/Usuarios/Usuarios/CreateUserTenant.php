<?php

namespace App\Livewire\Tenants\Usuarios\Usuarios;

use App\Models\Tenants\Tenant;
use App\Models\User;
use App\Models\Usuarios\CentralUser;
use App\Models\Usuarios\SimpleUser;
use App\Models\Usuarios\TenantUser;
use App\Models\Usuarios\UserInTenant;
use Stancl\Tenancy\Events\SyncedResourceSaved;

class CreateUserTenant
{

    private string $nombre;
    private string $email;
    private Tenant $tenant;

    public function __construct(string $nombre, string $email, Tenant $tenant)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->tenant = $tenant;
    }


    // metodos getter

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTenant()
    {
        return $this->tenant;
    }


    // metodos setters

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setTenant(Tenant $tenant): void
    {
        $this->tenant = $tenant;
    }

    public static function makeUserTenant(string $nombre, string $email, Tenant $tenant): self
    {
        return new self($nombre, $email, $tenant);
    }


    public function create()
    {
        $centralUser = CentralUser::where('email', $this->email)->first();

        if (! $centralUser) {
            $centralUser = CentralUser::create([
                'name' => $this->nombre,
                'email' => $this->email,
            ]);
        }

         //dd($centralUser);

        // Asociar el tenant sin duplicar
        $centralUser->tenants()->syncWithoutDetaching([$this->tenant->id]);

        SimpleUser::create([
            'name' => $this->nombre,
            'email' => $this->email,
            'email_verified_at' => $centralUser->email_verified_at,
            'global_id' => $centralUser->global_id,
            'workos_id' => $centralUser->workos_id,
            'avatar' => $centralUser->avatar,
        ]);

        return $centralUser;
    }

    // eliminar usuarios desde un tenat
    public function delete()
    {
        UserInTenant::where('email', $this->email)->delete();
        CentralUser::where('email', $this->email)->first()?->tenants()->detach($this->tenant->id);
        tenancy()->initialize($this->tenant);
    }
}
