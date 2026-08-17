<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'SusthoCare',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */
    'logo' => '<b>SusthoCare</b>',
    'logo_img' => null,
    'logo_img_class' => null,
    'logo_img_xl' => null,
    'logo_img_xl_class' => null,
    'logo_img_alt' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/sorkar.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/sorkar.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 300,
            'height' => 250,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => false,
    'layout_fixed_footer' => false,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => 'navbar-white',
    'classes_brand_text' => 'text-dark',

    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',

    'classes_sidebar' => 'sidebar-light elevation-1',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',


    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => false,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar' => [
        // This keeps all submenus expanded (prevents auto-collapse)
        'accordion' => false,
        'animation_speed' => 0, // Optional: disables animation
    ],

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => true,

    'dashboard_url' => 'dashboard.default',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    'password_reset_url' => 'password.request',

    'password_email_url' => 'password.email',

    'profile_url' => 'user_profile_show',

    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */
    'menu' => [

        /*
    |--------------------------------------------------------------------------
    | TOP NAVBAR
    |--------------------------------------------------------------------------
    */

        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],


        /* =========================================================
| ADMIN DASHBOARD
========================================================= */
        [
            'text' => 'Admin Panel',
            'route' => 'dashboard.default',
            'can' => 'dashboard.default',
            'icon' => 'fas fa-chart-line',
            'icon_color' => 'primary',
        ],

        /* =========================================================
| DOCTOR DASHBOARD
========================================================= */
        [
            'text' => 'Doctor Workspace',
            'route' => 'dashboard.doctor',
            'can' => 'dashboard.doctor',
            'icon' => 'fas fa-user-md',
            'icon_color' => 'info',
        ],

        /* =========================================================
| PATIENT / USER DASHBOARD
========================================================= */
        [
            'text' => 'Patient Portal',
            'route' => 'dashboard.user',
            'icon' => 'fas fa-user-circle',
            'icon_color' => 'success',
        ],
        /*Appointment Menu*/

        [
            'text' => 'Appointment Management',
            'icon' => 'fas fa-calendar-check',
            'icon_color' => 'primary',

            'submenu' => [

                [
                    'text' => 'All Appointments',
                    'route' => 'appointments.index',
                    'can' => 'appointments.index',
                    'icon' => 'fas fa-list-ul',
                ],

                // [
                //     'text' => 'Pending Appointments',
                //     'route' => 'appointments.pending',
                //     'can' => 'appointments.index',
                //     'icon' => 'fas fa-clock',
                // ],

                // [
                //     'text' => 'Confirmed Appointments',
                //     'route' => 'appointments.confirmed',
                //     'can' => 'appointments.index',
                //     'icon' => 'fas fa-check-circle',
                // ],

                // [
                //     'text' => 'Cancelled Appointments',
                //     'route' => 'appointments.cancelled',
                //     'can' => 'appointments.index',
                //     'icon' => 'fas fa-times-circle',
                // ],
            ],
        ],

        [
            'text' => 'Payment Records',
            'route' => 'payments.index',
            'can' => 'payments.index',
            'icon' => 'fas fa-credit-card',
            'icon_color' => 'success',
        ],

        [
            'text' => 'Contact Management',
            'icon' => 'fas fa-address-book',
            'icon_color' => 'primary',

            'submenu' => [

                [
                    'text' => 'All Contacts',
                    'route' => 'contacts.index',
                    'can' => 'contacts.index',
                    'icon' => 'fas fa-list-ul',
                ],

            ],
        ],
        /*
    |--------------------------------------------------------------------------
    | DOCTOR MANAGEMENT
    |--------------------------------------------------------------------------
    */

        [
            'text' => 'Doctor Management',
            'icon' => 'fas fa-user-md',
            'icon_color' => 'danger',

            'submenu' => [

                [
                    'text'  => 'Doctor List',
                    'route' => 'doctors.index',
                    'can'   => 'doctors.index',
                    'icon'  => 'fas fa-list',
                ],

                [
                    'text'  => 'Add Doctor',
                    'route' => 'doctors.create',
                    'can'   => 'doctors.create',
                    'icon'  => 'fas fa-user-plus',
                ],

                [
                    'text'  => 'Doctor Schedule',
                    'route' => 'doctor-schedules.index',
                    'can'   => 'doctor-schedules.index',
                    'icon'  => 'fas fa-calendar-alt',
                ],
            ],
        ],

        /*
    |--------------------------------------------------------------------------
    | SERVICE MANAGEMENT
    |--------------------------------------------------------------------------
    */

        [
            'text' => 'Service Management',
            'icon' => 'fas fa-concierge-bell',
            'icon_color' => 'warning',

            'submenu' => [

                [
                    'text' => 'Service List',
                    'route' => 'services.index',
                    'can' => 'services.index',
                    'icon' => 'fas fa-list',
                ],

                [
                    'text' => 'Add Service',
                    'route' => 'services.create',
                    'can' => 'services.create',
                    'icon' => 'fas fa-plus-circle',
                ],
            ],
        ],

        /*
    |--------------------------------------------------------------------------
    | BLOG MANAGEMENT
    |--------------------------------------------------------------------------
    */

        [
            'text' => 'Blog Management',
            'icon' => 'fas fa-blog',
            'icon_color' => 'info',

            'submenu' => [

                [
                    'text' => 'All Blogs',
                    'url' => 'admin/blog',
                    'can' => 'manage-blog',
                    'icon' => 'fas fa-newspaper',
                ],
            ],
        ],

        /*
    |--------------------------------------------------------------------------
    | SYSTEM SETTINGS
    |--------------------------------------------------------------------------
    */

        [
            'text' => 'System Settings',
            'icon' => 'fas fa-cogs',
            'icon_color' => 'secondary',

            'submenu' => [

                [
                    'text' => 'Role Management',
                    'route' => 'roles.index',
                    'can' => 'roles.index',
                    'active' => ['roles*'],
                    'icon' => 'fas fa-user-shield',
                ],

                [
                    'text' => 'Permission Management',
                    'route' => 'permissions.index',
                    'can' => 'permissions.index',
                    'active' => ['permissions*'],
                    'icon' => 'fas fa-key',
                ],

                [
                    'text' => 'Newsletter Updates',
                    'route' => 'newsletters.index',
                    'can' => 'newsletters.index',
                    'active' => ['newsletters*'],
                    'icon' => 'fas fa-users-cog',
                ],
                [
                    'text' => 'System Users',
                    'route' => 'system_users.index',
                    'can' => 'system_users.index',
                    'active' => ['system_users*'],
                    'icon' => 'fas fa-users-cog',
                ],
            ],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
        // MenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js',
                ],
            ],
        ],

        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],

        'BsCustomFileInput' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js',
                ],
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
