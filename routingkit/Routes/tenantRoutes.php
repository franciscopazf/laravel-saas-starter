<?php

use Rk\RoutingKit\Entities\RkRoute;
// use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

return [

    RkRoute::makeGroup('tenants')
        ->setUrlMiddleware([
            'web',
            // InitializeTenancyBySubdomain::class,
            InitializeTenancyByDomain::class,
            PreventAccessFromCentralDomains::class,
            'auth',
        ])
        ->setItems([

            RkRoute::make('dashboard')
                ->setUrl('/dashboard')
                ->setUrlMethod('get')
                ->setUrlController('App\Livewire\Central\Dashboard\Home\Home')
                ->setRoles(['admin_comunidad'])
                ->setItems([])
                ->setEndBlock('dashboard'),

            RkRoute::make('tenantsusers')
                ->setAccessPermission('acceder-listusuarios_SFs')
                ->setUrlMethod('get')
                ->setUrlController('App\Livewire\Tenants\Usuarios\Usuarios\ListUsuarios')
                ->setRoles(['admin_comunidad'])
                ->setItems([])
                ->setEndBlock('tenantsusers'),

            RkRoute::make('tenant_settings.profile')
                ->setParentId('tenants')
                ->setUrl('/profile')
                ->setUrlMethod('get')
                ->setUrlController('App\Livewire\Universal\Settings\Profile')
                ->setRoles(['admin_general'])
                ->setItems([])
                ->setEndBlock('tenant_settings.profile'),

            RkRoute::make('tenant_settings.appearance')
                ->setParentId('tenants')
                ->setUrl('/appearance')
                ->setUrlMethod('get')
                ->setUrlController('App\Livewire\Universal\Settings\Appearance')
                ->setRoles(['admin_general'])
                ->setItems([])
                ->setEndBlock('tenant_settings.appearance'),
        ])
        ->setEndBlock('tenants'),
];
