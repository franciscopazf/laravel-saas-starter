<?php

namespace App\Models\Usuarios;

use App\Models\Tenants\Tenant;
use App\Models\Tenants\TenantPivot;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Stancl\Tenancy\Database\Models\TenantPivot as ModelsTenantPivot;

class TenantUser extends ModelsTenantPivot
{
    protected $table = 'tenant_users';

    protected $fillable = [
        'tenant_id',
        'global_user_id',
    ];

    protected $casts = [
        'tenant_id' => 'string',
        'global_user_id' => 'string',
    ];


    protected static function booted()
    {
        static::created(function ($pivot) {
            // Algo cuando se agrega la relación
        });

        static::deleted(function ($pivot) {
            // Algo cuando se quita la relación
            $centralUser = $pivot->globalUser; // Obtienes el CentralUser asociado
            $centralUser->deleteUserFromTenant($pivot->tenant); // Llamas al método para eliminar el usuario del tenant
        });
    }

    // relacion con el usuario global
    public function globalUser()
    {
        return $this->belongsTo(CentralUser::class, 'global_user_id', 'global_id');
    }


    // relacion con el inquilino
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }



    // relacion con el modelo usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'global_user_id', 'id');
    }
}
