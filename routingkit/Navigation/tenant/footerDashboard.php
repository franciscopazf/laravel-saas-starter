<?php

use Rk\RoutingKit\Entities\RkNavigation;

return [

    RkNavigation::makeGroup('tenant_settings_group')
        ->setLabel('Ajustes')
        ->setHeroIcon('cog')
        ->setItems([])
        ->setEndBlock('tenant_settings_group'),

    RkNavigation::make('tenant_settings.profile')
        ->setParentId('tenant_settings_group')
        ->setLabel('Profile Settings')
        ->setHeroIcon('cog')
        ->setItems([])
        ->setEndBlock('tenant_settings.profile'),

    RkNavigation::make('tenant_settings.appearance')
        ->setParentId('tenant_settings_group')
        ->setLabel('Ajustes de Apariencia')
        ->setHeroIcon('paint-brush')
        ->setItems([])
        ->setEndBlock('tenant_settings.appearance'),

];
