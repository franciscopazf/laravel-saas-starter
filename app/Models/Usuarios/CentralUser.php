<?php

namespace App\Models\Usuarios;

use App\Models\Tenants\Tenant;
use App\Models\Tenants\TenantPivot as TenantsTenantPivot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stancl\Tenancy\Database\Concerns\CentralConnection;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;
use Stancl\Tenancy\Contracts\SyncMaster;
use App\Models\Usuarios\TenantPivot; // Si existe en tu estructura
use App\Models\User; // Para getTenantModelName()
use App\Models\Usuarios\UserInTenant;
use Spatie\Permission\Traits\HasRoles;

class CentralUser extends Model implements SyncMaster
{
    // Note that we force the central connection on this model
    use ResourceSyncing, CentralConnection;
    use HasRoles;


    protected $guarded = [];
    public $timestamps = false;
    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'global_id',
        'workos_id',
        'tenant_seleccionado_id',
        'is_central_user',
        'avatar',
    ];



    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->updateDataInTenants();
        });

        static::updating(function ($model) {
            
        });
    }


    public function deleteUserFromTenant(Tenant $tenant)
    {
        tenancy()->initialize($tenant); // Cambiar al contexto del tenant

        // Buscar y eliminar al usuario dentro del tenant
        $userInTenant = \App\Models\Usuarios\UserInTenant::where('email', $this->email)->first();
        if ($userInTenant) {
            $userInTenant->delete();
        }

        tenancy()->end(); // Volver al contexto central
    }


    public function updateDataInTenants()
    {
        $this->tenants()->each(function ($tenant) {
            $this->deleteUserFromTenant($tenant);
        });
    }


    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'tenant_users', 'global_user_id', 'tenant_id', 'global_id')
            ->using(TenantUser::class);
    }

    public function onlyTenants(): BelongsToMany
    {
        return $this->belongsToMany(
            Tenant::class,
            'tenant_users',
            'global_user_id',
            'tenant_id'
        ); 
    }

    public function hasOnlyOneTenant(): bool
    {
        return $this->tenants()->count() === 1;
    }

    public function tenantPivots()
    {
        return $this->hasMany(TenantUser::class, 'global_user_id', 'global_id');
    }


    public function getTenantModelName(): string
    {
        return  UserInTenant::class;
    }

    public function getGlobalIdentifierKey()
    {
        return $this->getAttribute($this->getGlobalIdentifierKeyName());
    }

    public function getGlobalIdentifierKeyName(): string
    {
        return 'global_id';
    }

    public function getCentralModelName(): string
    {
        return static::class;
    }

    public function getSyncedAttributeNames(): array
    {
        return [
            'name',
            'global_id',
            'email',
        ];
    }
}
