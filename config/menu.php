<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Navigation Menu
    |--------------------------------------------------------------------------
    |
    | This array is for Navigation menus of the backend.  Just add/edit or
    | remove the elements from this array which will automatically change the
    | navigation.
    |
    */

    // SIDEBAR LAYOUT - MENU

    'sidebar' => [
        [
            'title' => 'Dashboard',
            'link' => '/admin/dashboard/',
            'active' => 'admin/dashboard*',
            'slug' => 'view.users',
            'icon' => 'icon-fa icon-fa-dashboard',
        ],
        [
            'title' => 'Users',
            'link' => '#',
            'active' => 'admin/manage-users*',
            'icon' => 'icon-fa icon-fa-user',
            'slug' => 'view.users',
            'children' => [
                [
                    'title' => 'Users',
                    'link' => '/admin/manage-users/users',
                    'active' => 'admin/manage-users/users*',
                    'slug' => 'view.users',
                ],
                [
                    'title' => 'Roles',
                    'link' => '/admin/manage-users/roles',
                    'active' => 'admin/manage-users/roles*',
                    'slug' => 'view.roles',
                ],
                [
                    'title' => 'Permissions',
                    'link' => '/admin/manage-users/permissions',
                    'active' => 'admin/manage-users/permissions*',
                    'slug' => 'view.permissions',
                ],
            ]
        ],
        [
            'title' => 'Employees',
            'link' => '#',
            'active' => 'admin/manage-employees*',
            'slug' => 'view.employees',
            'icon' => 'icon-fa icon-fa-users',
            'children' => [
                [
                    'title' => 'Employees',
                    'link' => '/admin/manage-employees/employees',
                    'active' => 'admin/manage-employees/Employees*',
                    'slug' => 'view.employees',
                ],
                [
                    'title' => 'Attendance',
                    'link' => '/admin/manage-employees/attendance',
                    'active' => '/admin/manage-employees/attendance*',
                    'slug' => 'view.attendance',
                ],
                [
                    'title' => 'Leave',
                    'link' => '/admin/permissions/1',
                    'active' => 'admin/users/*',
                    'slug' => 'view.users',
                ],
            ]
        ],
        [
            'title' => 'Store',
            'link' => '#',
            'active' => 'admin/manage-store*',
            'slug' => 'view.categories',
            'icon' => 'icon-fa icon-fa-th-large',
            'children' => [
                [
                    'title' => 'Category',
                    'link' => '/admin/manage-store/categories',
                    'active' => 'admin/manage-store/categories*',
                    'slug' => 'view.categories',
                ],
                [
                    'title' => 'Product',
                    'link' => '/admin/manage-store/products',
                    'active' => 'admin/manage-store/products*',
                    'slug' => 'view.products',
                ],
                [
                    'title' => 'Brand',
                    'link' => '/admin/manage-store/brands',
                    'active' => 'admin/manage-store/brands*',
                    'slug' => 'view.brands',
                ],
            ]
        ],
        [
            'title' => 'Customers',
            'link' => '#',
            'active' => 'admin/manage-customers*',
            'slug' => 'view.customers',
            'icon' => 'icon-fa icon-fa-users',
            'children' => [
                [
                    'title' => 'Customer',
                    'link' => '/admin/manage-customers/customers',
                    'active' => 'admin/manage-customers/Customers*',
                    'slug' => 'view.customers',
                ],
            ]
        ],
        [
            'title' => 'Manage Payment',
            'link' => '#',
            'active' => 'admin/manage-payment*',
            'icon' => 'icon-fa icon-fa-th-large',
            'slug' => 'view.payee',
            'children' => [
                [
                    'title' => 'Billing',
                    'link' => '/admin/manage-payment/billing',
                    'active' => 'admin/manage-payment/billing*',
                    'slug' => 'view.billing',
                ],
                [
                    'title' => 'Make Payment',
                    'link' => '/admin/manage-payment/make-payment',
                    'active' => 'admin/manage-payment/make-payment*',
                    'slug' => 'view.payee',
                ],
                [
                    'title' => 'Generate Bill',
                    'link' => '/admin/manage-payment/generate-bill',
                    'active' => 'admin/manage-payment/generate-bill*',
                    'slug' => 'view.billing',
                ],
                [
                    'title' => 'Payment Type',
                    'link' => '/admin/manage-payment/payment-type',
                    'active' => 'admin/manage-payment/payment-type*',
                    'slug' => 'view.payment.types',
                ],
            ]
        ],
        [
            'title' => 'Charts',
            'link' => '#',
            'active' => 'admin/charts*',
            'icon' => 'icon-fa icon-fa-bar-chart',
            'slug' => 'view.users',
            'children' => [
                [
                    'title' => 'Chart JS',
                    'link' => '/admin/charts/chartjs',
                    'active' => 'admin/charts/chartjs',
                    'slug' => 'view.users',
                ],
                [
                    'title' => 'Sparkline',
                    'link' => '/admin/charts/sparklines',
                    'active' => 'admin/charts/sparklines',
                    'slug' => 'view.users',
                ],
                [
                    'title' => 'AM Charts',
                    'link' => '/admin/charts/amcharts',
                    'active' => 'admin/charts/amcharts',
                    'slug' => 'view.users',
                ],
                [
                    'title' => 'Morris',
                    'link' => '/admin/charts/morris',
                    'active' => 'admin/charts/morris',
                    'slug' => 'view.users',
                ],
                [
                    'title' => 'Gauges',
                    'link' => '/admin/charts/gauges',
                    'active' => 'admin/charts/gauges',
                    'slug' => 'view.users',
                ],
            ]
        ],
        [
            'title' => 'Settings',
            'link' => '#',
            'active' => 'admin/settings*',
            'icon' => 'icon-fa icon-fa-cogs',
            'slug' => 'view.users',
            'children' => [
                [
                    'title' => 'Zones',
                    'link' => '/admin/settings/zones',
                    'active' => 'admin/settings/zones*',
                    'slug' => 'view.zones',
                ],
                [
                    'title' => 'Departments',
                    'link' => '/admin/settings/departments',
                    'active' => 'admin/settings/departments*',
                    'slug' => 'view.departments',
                ],
                [
                    'title' => 'Designations',
                    'link' => '/admin/settings/designations',
                    'active' => 'admin/settings/designations*',
                    'slug' => 'view.designations',
                ],
                [
                    'title' => 'countries',
                    'link' => '/admin/settings/countries',
                    'active' => 'admin/settings/countries*',
                    'slug' => 'view.country',
                ],
                [
                    'title' => 'State',
                    'link' => '/admin/settings/states',
                    'active' => 'admin/settings/states*',
                    'slug' => 'view.state',
                ],
                [
                    'title' => 'Local Government Areas',
                    'link' => '/admin/settings/lgas',
                    'active' => 'admin/settings/lgas*',
                    'slug' => 'view.lga',
                ],
                [
                    'title' => 'Social',
                    'link' => '/admin/settings/social',
                    'active' => 'admin/settings/social',
                    'slug' => 'view.users',
                ],
                [
                    'title' => 'Mail Driver',
                    'link' => 'admin/settings/mail',
                    'active' => 'admin/settings/mail*',
                    'slug' => 'view.users',
                ],
            ]
        ],
    ],
];
