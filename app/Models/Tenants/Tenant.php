<?php

namespace App\Models\Tenants;

use App\Clases\Tenants\BuilderTenant;
use App\Models\Usuarios\TenantUser;
use App\Models\Usuarios\UserInTenant;
use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Model;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;



class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $table = 'tenants';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'data',
    ];


    public static function boot()
    {
        parent::boot();

        static::created(function ($tenant) {
            BuilderTenant::make($tenant)->run();
        });
    }


    protected $casts = [
        'data' => 'json',
    ];


    public function getDomainAttribute()
    {
        return $this->domains->first();
    }



    // relacion de muchos a muchos con usuarios
    public function users()
    {
        return $this->belongsToMany(
            UserInTenant::class,
            'tenant_users',
            'tenant_id',        // foreignPivotKey → apunta al modelo actual (Tenant)
            'global_user_id',   // relatedPivotKey → apunta al modelo UserInTenant
            'id',               // parentKey → clave primaria en Tenant
            'global_id'         // relatedKey → clave primaria en UserInTenant
        );
    }



    // funcion para redireccionar al usuario al dominio del tenant 
    public function redirectToDomain()
    {
        $domain = $this->domains()->first();

        if (!$domain) {
            return; // o redirige a una página por defecto
        }

        // Determinar protocolo y puerto según entorno
        if (app()->environment('production')) {
            $scheme = 'https://';
            $port = ''; // en producción no agregamos puerto
        } else {
            $scheme = 'http://';
            $port = ':8000';
        }

        // Construir la URL
        $url = $scheme . $domain->domain . $port;

        // Evitar bucle de redirección si ya estamos en el dominio correcto
        if (request()->getHost() === $domain->domain) {
            return; // o seguir con la ejecución normal
        }

        return redirect()->away($url);
    }
}
