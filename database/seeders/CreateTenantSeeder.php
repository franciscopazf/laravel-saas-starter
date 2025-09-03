<?php

namespace Database\Seeders;

use App\Models\Tenants\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class CreateTenantSeeder extends Seeder
{
    public function run(): void
    {
        // $baseHost = parse_url(config('app.url'), PHP_URL_HOST);
        // Crear el tenant
        $tenant = \App\Models\Tenants\Tenant::create([
            'name' => 'comunidad1',
            'email' => 'comunidad1@example.com',
            'phone' => '123-456-7890',
            'data' => [
                'custom_field' => 'value',
            ],
        ]);

        $tenant->domains()->create([
            'domain' => 'comunidad1.devapp.local'
        ]);

        // crear tenant de jacalito 

        $tenant = \App\Models\Tenants\Tenant::create([
            'name' => 'jacalito',
            'email' => 'jacalito@example.com',
            'phone' => '123-456-7890',
            'data' => [
                'custom_field' => 'value',
            ],
        ]);

        $tenant->domains()->create([
            'domain' => 'jacalito.devapp.local'
        ]);
    }
}
