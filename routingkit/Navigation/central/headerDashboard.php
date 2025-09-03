<?php

use Rk\RoutingKit\Entities\RkNavigation;

return [

    RkNavigation::makeGroup('admin_general')
        ->setItems([

            RkNavigation::makeGroup('inicio')
                ->setParentId('admin_general')
                ->setHeroIcon('home')
                ->setItems([

                    RkNavigation::make('dashboard_central')
                        ->setParentId('inicio')
                        ->setDescription('Panel de control de la aplicacion central')
                        ->setHeroIcon('presentation-chart-bar')
                        ->setItems([])
                        ->setEndBlock('dashboard_central'),
                ])
                ->setEndBlock('inicio'),

            RkNavigation::makeGroup('Usuarios')
                ->setParentId('admin_general')
                ->setHeroIcon('users')
                ->setItems([

                    RkNavigation::make('listusuarios_uJJ')
                        ->setParentId('Usuarios')
                        ->setHeroIcon('user-group')
                        ->setItems([])
                        ->setEndBlock('listusuarios_uJJ'),
                ])
                ->setEndBlock('Usuarios'),

            RkNavigation::makeGroup('tenants')
                ->setParentId('admin_general')
                ->setHeroIcon('building-office-2')
                ->setItems([

                    RkNavigation::make('listtenants_eUE')
                        ->setParentId('tenants')
                        ->setHeroIcon('building-library')
                        ->setItems([])
                        ->setEndBlock('listtenants_eUE'),
                ])
                ->setEndBlock('tenants'),

            RkNavigation::makeGroup('acceso')
                ->setParentId('admin_general')
                ->setDescription('Gestiona los roles y permisos de la aplicacion')
                ->setLabel('Acceso')
                ->setHeroIcon('lock-closed')
                ->setItems([

                    RkNavigation::make('roles_list')
                        ->setParentId('acceso')
                        ->setDescription('Gestiona los roles de la aplicacion')
                        ->setLabel('Roles')
                        ->setHeroIcon('shield-check')
                        ->setItems([])
                        ->setEndBlock('roles_list'),

                    RkNavigation::make('list_usuarios')
                        ->setParentId('acceso')
                        ->setDescription('Gestiona los usuarios de la aplicacion')
                        ->setLabel('Usuarios')
                        ->setHeroIcon('users')
                        ->setItems([])
                        ->setEndBlock('list_usuarios'),

                    RkNavigation::make('list_permisos')
                        ->setParentId('acceso')
                        ->setDescription('Gestiona los permisos de la aplicacion')
                        ->setLabel('Permisos')
                        ->setHeroIcon('key')
                        ->setItems([])
                        ->setEndBlock('list_permisos'),
                ])
                ->setEndBlock('acceso'),
        ])
        ->setEndBlock('admin_general'),

    RkNavigation::make('seleccionartenant_uFN')
        ->setDescription('Selecciona el tenant con el que quieres trabajar')
        ->setLabel('Seleccionar Tenant')
        ->setHeroIcon('arrow-path')
        ->setItems([])
        ->setEndBlock('seleccionartenant_uFN'),

 
];
