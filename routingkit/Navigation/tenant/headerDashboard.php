<?php

use Rk\RoutingKit\Entities\RkNavigation;

return [

    RkNavigation::makeGroup('admin_comunidad')
        ->setItems([

            RkNavigation::makeGroup('inicio')
                ->setParentId('admin_comunidad')
                ->setHeroIcon('home')
                ->setItems([

                    RkNavigation::make('dashboard')
                        ->setParentId('inicio')
                        ->setDescription('Panel de control de la aplicacion central')
                        ->setHeroIcon('presentation-chart-bar')
                        ->setItems([])
                        ->setEndBlock('dashboard'),
                ])
                ->setEndBlock('inicio'),

            RkNavigation::makeGroup('gestion_comunidad')
                ->setParentId('admin_comunidad')
                ->setDescription('Gestiona los usuarios de la comunidad')
                ->setLabel('Gestion')
                ->setHeroIcon('users')
                ->setItems([

                    RkNavigation::make('tenantsusers')
                        ->setParentId('gestion_comunidad')
                        ->setDescription('Gestiona los usuarios del inquilino')
                        ->setLabel('Usuarios')
                        ->setHeroIcon('user-group')
                        ->setItems([])
                        ->setEndBlock('tenantsusers'),
                ])
                ->setEndBlock('gestion_comunidad'),
        ])
        ->setEndBlock('admin_comunidad'),
];
