<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Livewire Support
    |--------------------------------------------------------------------------
    |
    | This option enables or disables specific functionalities related to
    | Livewire components within your package. When set to true, it might
    | activate Livewire-specific parsing or routing behaviors.
    |
    */
    'livewire_support' => true,

    /*
    |--------------------------------------------------------------------------
    | Controllers Paths
    |--------------------------------------------------------------------------
    |
    | Define the base paths where your application's controllers and Livewire
    | components are located. These paths are used, for example, by the
    | RkFileBrowser to allow interactive selection of classes.
    |
    | Each key represents a directory path (relative to base_path()),
    | and its value is a user-friendly label for that path.
    |
    */
    'controllers_path' => [ 
        base_path('app/Http/Controllers'),
        base_path('app/Livewire')
    ],

    // data para los stubs

    'stubs' => [
        'simple_controller' => [
            'controllers' => [
                [
                    'label' => 'Simple Controller',
                    'default_name' => '{modelo}ListController',
                    'extension' => '.php',
                    'stub_path' => base_path('routingkit/Stubs/carpeta1/simplecontroller.blade.php'),
                    'stub_type' => 'blade',
                    'rk_route' => true,
                    'rk_navigation' => true,
                    'views' => [
                        [
                            'extension' => '.blade.php',
                            'stub_path' => base_path('routingkit/Stubs/carpeta1/simpleviewcontroller.blade.php'),
                            'stub_type' => 'blade'
                        ],

                    ]
                ]
            ],
        ],
        'filament_table' => [
            'controllers' => [
                [
                    'label' => 'Filament Table',
                    'default_name' => '{modelo}List',
                    'extension' => '.php',
                    'stub_path' => base_path('routingkit/Stubs/filament/filamenttable.blade.php'),
                    'stub_type' => 'blade',
                    'rk_route' => true,
                    'rk_navigation' => true,
                    'views' => [
                        [
                            'extension' => '.blade.php',
                            'stub_path' => base_path('routingkit/Stubs/filament/filamenttableview.blade.php'),
                            'stub_type' => 'blade'
                        ],

                    ]
                ]
            ],
        ],
    ],


    'user_model' => \App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Route Entity Model
    |--------------------------------------------------------------------------
    |
    | Specify the fully qualified class name (FQCN) of the model that
    | represents your routes. This model should extend RkBaseEntity
    | and is used throughout the RoutingKit package for managing route data.
    |
    */
    'model_ussage' => \Rk\RoutingKit\Entities\RkRoute::class,

    /*
    |--------------------------------------------------------------------------
    | Route File Paths Configuration
    |--------------------------------------------------------------------------
    |
    | Configure where your routes will be saved and how they are structured.
    | This section defines different storage strategies for your routes.
    |
    | 'default_file': Specifies the default strategy (key from 'items').
    | 'items': An array defining each route storage strategy.
    |   - 'path': The full path to the file where routes are stored.
    |   - 'support_file': Indicates the structure of the data within the file
    |                     (e.g., "object_file_tree", "object_file_plain").
    |   - 'only_string_support': If true, indicates that the file expects
    |                            only string values for certain configurations.
    |
    */
    'routes_file_path' => [
        'default_file' => 'dashboard_routes',
        'items'        => [
            'dashboard_routes' => [
                'path'              => base_path('routingkit/Routes/rkRoutes.php'),
                'support_file'      => "object_file_tree",
                'only_string_support' => false,
            ],

            'tenant_routes' => [
                'path'              => base_path('routingkit/Routes/tenantRoutes.php'),
                'support_file'      => "object_file_tree",
                'only_string_support' => false,
            ],

            'universal_routes' => [
                'path'              => base_path('routingkit/Routes/universalRoutes.php'),
                'support_file'      => "object_file_tree",
                'only_string_support' => false,
            ],

            //...
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Navigation File Paths Configuration
    |--------------------------------------------------------------------------
    |
    | Configure where your navigation data will be saved and how it is structured.
    | This section defines different storage strategies for your navigations,
    | similar to how routes are handled.
    |
    | 'default_file': Specifies the default navigation file (key from 'items').
    | 'items': An array defining each navigation storage strategy.
    |   - 'path': The full path to the file where navigation data is stored.
    |   - 'support_file': Indicates the structure of the data within the file.
    |   - 'only_string_support': If true, indicates that the file expects
    |                            only string values for certain configurations.
    |
    */
    'navigators_file_path' => [
        'default_file' => 'headerDashboard',
        'items'        => [
            'dashboard_navigators' => [
                'path'              => base_path('routingkit/Navigation/central/rkNavigation.php'),
                'support_file'      => "object_file_plain",
                'only_string_support' => true,
            ],

            'headerDashboard' => [
                'path'              => base_path('routingkit/Navigation/central/headerDashboard.php'),
                'support_file'      => "object_file_tree",
                'only_string_support' => true,
            ],

            'footerDashboard' => [
                'path'              => base_path('routingkit/Navigation/central/footerDashboard.php'),
                'support_file'      => "object_file_plain",
                'only_string_support' => true,
            ],

            'tenant_dashboard_navigators' => [
                'path'              => base_path('routingkit/Navigation/tenant/rkNavigation.php'),
                'support_file'      => "object_file_plain",
                'only_string_support' => true,
            ],

            'tenant_headerDashboard' => [
                'path'              => base_path('routingkit/Navigation/tenant/headerDashboard.php'),
                'support_file'      => "object_file_tree",
                'only_string_support' => true,
            ],

            'tenant_footerDashboard' => [
                'path'              => base_path('routingkit/Navigation/tenant/footerDashboard.php'),
                'support_file'      => "object_file_plain",
                'only_string_support' => true,
            ],
            // ...
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Roles
    |--------------------------------------------------------------------------
    |
    | Define the roles available in your application. These roles can be
    | used for permission management and access control within your routes
    | and navigation. These are typically used for console prompts
    | and internal logic.
    |
    | The keys are the internal identifiers for the roles, and the values
    | are often the same for simplicity or can be descriptive names.
    |
    */
    'roles' => [
        [
            'id'   => 'admin_general',
            'name' => 'admin_general',
            'for_tenant' => false
        ],
        [
            'id'   => 'admin_comunidad',
            'name' => 'admin_comunidad',
            'for_tenant' => true
        ],
        [
            'id'   => 'user_comunidad',
            'name' => 'user_comunidad',
            'for_tenant' => true
        ],
        [
            'id'   => 'guest',
            'name' => 'guest',
            'for_tenant' => true
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Development Users
    |--------------------------------------------------------------------------
    |
    | Configure credentials and roles for development-specific users.
    | These users can be automatically created or seeded during development
    | to facilitate testing and access control setup.
    |
    | It's recommended to store sensitive information like email and password
    | in your .env file and access them using the env() helper.
    |
    */
    'development_users' => [
        'admin_general' => [
            'user' => [
                'name' => "Administrador",
                'email' => env('MAIL_ADMIN_ADDRESS'),
                'is_central_user' => true
            ],
            'roles'    => ['admin_general', 'admin_comunidad'],
        ],
    ],




];
