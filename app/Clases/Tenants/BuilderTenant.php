<?php

namespace App\Clases\Tenants;

use App\Models\Tenants\Tenant;
use Database\Seeders\DataTenantSeeder;
use Illuminate\Support\Facades\Artisan;

class BuilderTenant
{

    private Tenant $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public  static function make(Tenant $tenant): BuilderTenant
    {
        // dd($tenant);
        return new self($tenant);
    }


    public  function run()
    {
        $this->InitializeContext();
        $this->migrateTenant();
        $this->seedTenant();
        $this->rkCommand();
        $this->createTenantFolder();
        $this->endContext();
    }

    // iniciar contexto funcion
    public function InitializeContext()
    {
        tenancy()->initialize($this->tenant);
    }

    // ejecutar migraciones de tenant
    public function migrateTenant()
    {
        Artisan::call('tenants:migrate', [
            '--force' => true,
            '--tenants' => [$this->tenant->id],
        ]);
    }

    // crear la carpeta para el tenant de este modo tenant6e2db2e2-9d5b-4701-82d2-449601530c8a
    // y consederle permisos necesarios
    public function createTenantFolder()
    {
        $tenantFolder = storage_path("framework/cache");
        if (!file_exists($tenantFolder))
            mkdir($tenantFolder, 0755, true);
    }

    // ejecutar seeders de tenant

    public function seedTenant()
    {
        Artisan::call('db:seed', [
            '--class' => DataTenantSeeder::class,
            '--force' => true,
        ]);
    }

    public function rkCommand()
    {
        Artisan::call('rk:access', [
            '--force' => true,
            '--tenants' => true,
        ]);
    }


    public function endContext()
    {
        tenancy()->end();

        // inciiar la conexion con la BD central
    }
}
