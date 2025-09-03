<?php

use Rk\RoutingKit\Entities\RkNavigation;

return [

    RkNavigation::makeGroup('central_settings_group')
        ->setLabel('Ajustes')
        ->setHeroIcon('cog')
        ->setItems([])
        ->setEndBlock('central_settings_group'),

    RkNavigation::make('central_settings.profile')
        ->setParentId('central_settings_group')
        ->setLabel('Profile Settings')
        ->setHeroIcon('cog')
        ->setItems([])
        ->setEndBlock('central_settings.profile'),

    RkNavigation::make('central_settings.appearance')
        ->setParentId('central_settings_group')
        ->setLabel('Ajustes de Apariencia')
        ->setHeroIcon('paint-brush')
        ->setItems([])
        ->setEndBlock('central_settings.appearance'),

];
