<?php

use Rk\RoutingKit\Entities\RkRoute;

return [

    RkRoute::makeGroup('central_app')
        ->setDomains(config('tenancy.central_domains') ?? [])
    // ->setPermissions(['acceder-aplicacion-central'])
        ->setItems([

            RkRoute::makeGroup('auth')
                ->setParentId('central_app')
                ->setItems([

                    RkRoute::make('redirect')
                        ->setParentId('auth')
                    // ->setAccessPermission('acceder-home-central')
                        ->setUrl('/redirect')
                        ->setUrlMethod('get')
                        ->setUrlController('App\Http\Controllers\Auth\RedirectCentralController@redirect')
                        ->setItems([])
                        ->setEndBlock('redirect'),

                    RkRoute::make('dashboard_central')
                        ->setParentId('auth')
                        ->setAccessPermission('acceder-dashboard_central')
                        ->setUrl('/dashboard_central')
                        ->setUrlMethod('get')
                        ->setUrlController('App\Livewire\Central\Dashboard\Home\Home')
                        ->setRoles(['admin_general'])
                        ->setItems([])
                        ->setEndBlock('dashboard_central'),

                    RkRoute::makeGroup('admin_general')
                        ->setParentId('auth')
                        ->setItems([

                            RkRoute::make('listusuarios_uJJ')
                                ->setParentId('admin_general')
                                ->setAccessPermission('acceder-listusuarios_uJJ')
                                ->setUrl('/listusuarios_uJJ')
                                ->setUrlMethod('get')
                                ->setUrlController('App\Livewire\Central\Usuarios\Usuarios\ListUsuarios')
                                ->setRoles(['admin_general'])
                                ->setItems([])
                                ->setEndBlock('listusuarios_uJJ'),

                            RkRoute::make('listtenants_eUE')
                                ->setParentId('admin_general')
                                ->setAccessPermission('acceder-listtenants_eUE')
                                ->setUrl('/listtenants_eUE')
                                ->setUrlMethod('get')
                                ->setUrlController('App\Livewire\Central\Tenants\Tenant\ListTenants')
                                ->setRoles(['admin_general'])
                                ->setItems([])
                                ->setEndBlock('listtenants_eUE'),

                            RkRoute::make('roles_list')
                                ->setAccessPermission('acceder-roles-list')
                                ->setUrl('/roles_list')
                                ->setUrlMethod('get')
                                ->setUrlController('App\Livewire\Central\Acceso\Roles\ListRoles')
                                ->setRoles(['admin_general'])
                                ->setItems([])
                                ->setEndBlock('roles_list'),

                            RkRoute::make('list_permisos')
                                ->setAccessPermission('acceder-list-permisos')
                                ->setUrl('/list_permisos')
                                ->setUrlMethod('get')
                                ->setUrlController('App\Livewire\Central\Acceso\Permiso\ListPermisos')
                                ->setRoles(['admin_general'])
                                ->setItems([])
                                ->setEndBlock('list_permisos'),

                            RkRoute::make('list_usuarios')
                                ->setAccessPermission('acceder-list-usuarios')
                                ->setUrlMethod('get')
                                ->setUrlController('App\Livewire\Central\Acceso\Usuarios\ListUsuarios')
                                ->setRoles(['admin_general'])
                                ->setItems([])
                                ->setEndBlock('list_usuarios'),

                            
                        ])
                        ->setEndBlock('admin_general'),

                    RkRoute::makeGroup('central_users')
                        ->setParentId('auth')
                        ->setDomains([])
                        ->setItems([

                            RkRoute::make('seleccionartenant_uFN')
                                ->setParentId('central_users')
                            //  ->setAccessPermission('acceder-seleccionartenant_uFN')
                                ->setUrlMethod('get')
                                ->setUrlController('App\Livewire\Central\CentralUsers\SeleccionarTenant\SeleccionarTenant')
                                ->setDomains([])
                                ->setRoles(['admin_general'])
                                ->setItems([])
                                ->setEndBlock('seleccionartenant_uFN'),
                        ])
                        ->setEndBlock('central_users'),

                    RkRoute::make('central_settings.profile')
                        ->setParentId('auth')
                        ->setUrl('/profile')
                        ->setUrlMethod('get')
                        ->setUrlController('App\Livewire\Universal\Settings\Profile')
                        ->setDomains([])
                        ->setRoles(['admin_general'])
                        ->setItems([])
                        ->setEndBlock('central_settings.profile'),

                    RkRoute::make('central_settings.appearance')
                        ->setParentId('auth')
                        ->setUrl('/appearance')
                        ->setUrlMethod('get')
                        ->setUrlController('App\Livewire\Universal\Settings\Appearance')
                        ->setDomains([])
                        ->setRoles(['admin_general'])
                        ->setItems([])
                        ->setEndBlock('central_settings.appearance'),
                ])
                ->setEndBlock('auth'),

            RkRoute::makeGroup('settings_group')
                ->setParentId('central_app')
                ->setPrefix('/settings')
                ->setDomains([])
                ->setUrlMiddleware(['web', 'universal'])
                ->setItems([])
                ->setEndBlock('settings_group'),
        ])
        ->setEndBlock('central_app'),
];
