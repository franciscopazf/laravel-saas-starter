<?php

use Rk\RoutingKit\Entities\RkRoute;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

return [

    RkRoute::makeGroup('settings_group')
        ->setParentId('central_app')
        ->setUrlMiddleware([
            'web',
            'universal',
            //    InitializeTenancyByDomain::class,
        ])
        ->setPrefix('/settings')
        ->setItems([])
        ->setEndBlock('settings_group'),
];
