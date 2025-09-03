<?php

namespace App\Livewire\Central\CentralUsers\SeleccionarTenant;

use App\Models\Tenants\Tenant;
use App\Models\Usuarios\CentralUser;
use Illuminate\Support\Collection;
use Livewire\Component;

class SeleccionarTenant extends Component
{

    public Collection $tenants;
    public CentralUser $centralUser;
    public ?string $tenantSeleccionado = null;

    public function redirectToTenant()
    {
        $tenant = Tenant::find($this->tenantSeleccionado);
        if ($tenant) {
            $this->centralUser->tenant_seleccionado_id = $tenant->id;
            $this->centralUser->save();
            $tenant->redirectToDomain();
        }
    }

    public function mount()
    {
        $user = auth()->user();
        $this->centralUser = $user->centralUser;
        $this->tenants = $this->centralUser->tenants;
    }

    public function render()
    {
        return view('livewire.central.central-users.seleccionar-tenant.seleccionar-tenant');
    }
}
