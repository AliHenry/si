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
            'title' => 'Sells',
            'link' => '#',
            'active' => 'admin/sells*',
            'slug' => 'view.sells',
            'icon' => 'icon-fa icon-fa-th-large',
            'children' => [
                [
                    'title' => 'Sells',
                    'link' => '/admin/manage-sells/sells',
                    'active' => 'admin/manage-sells/sells*',
                    'slug' => 'view.sells',
                ],
                [
                    'title' => 'Loans',
                    'link' => '/admin/manage-sells/loans',
                    'active' => 'admin/manage-sells/loans*',
                    'slug' => 'view.loans',
                ],
                [
                    'title' => 'Payment Type',
                    'link' => '/admin/manage-sells/types',
                    'active' => 'admin/manage-sells/types*',
                    'slug' => 'view.payment.types',
                ],
                [
                    'title' => 'Payment Status',
                    'link' => '/admin/manage-sells/status',
                    'active' => 'admin/manage-sells/status*',
                    'slug' => 'view.payment.status',
                ],
            ]
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
                    'title' => 'Product',
                    'link' => '/admin/manage-store/products',
                    'active' => 'admin/manage-store/products*',
                    'slug' => 'view.products',
                ],
                [
                    'title' => 'Release Products',
                    'link' => '/admin/manage-store/release-products',
                    'active' => 'admin/manage-store/release-products*',
                    'slug' => 'view.release.products',
                ],
                [
                    'title' => 'Purchase',
                    'link' => '/admin/manage-store/purchase',
                    'active' => 'admin/manage-store/purchase*',
                    'slug' => 'view.purchase',
                ],
                [
                    'title' => 'Suppliers',
                    'link' => '/admin/manage-store/suppliers',
                    'active' => 'admin/manage-store/suppliers*',
                    'slug' => 'view.suppliers',
                ],
                [
                    'title' => 'Category',
                    'link' => '/admin/manage-store/categories',
                    'active' => 'admin/manage-store/categories*',
                    'slug' => 'view.categories',
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
            'title' => 'Manage Expenditure',
            'link' => '#',
            'active' => 'admin/manage-expenditure*',
            'icon' => 'icon-fa icon-fa-th-large',
            'slug' => 'view.expenditures',
            'children' => [
                [
                    'title' => 'Expenditures',
                    'link' => '/admin/manage-expenditure/expenditures',
                    'active' => 'admin/manage-expenditure/expenditures*',
                    'slug' => 'view.expenditures',
                ],
                [
                    'title' => 'Expenditures Type',
                    'link' => '/admin/manage-expenditure/expenditure-types',
                    'active' => 'admin/manage-expenditure/expenditure-types*',
                    'slug' => 'view.expenditure.types',
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
            'title' => 'Manage Audits',
            'link' => '#',
            'active' => 'admin/manage-audits*',
            'icon' => 'icon-fa icon-fa-th-large',
            'slug' => 'view.audit',
            'children' => [
                [
                    'title' => 'Sells Audit ',
                    'link' => '/admin/manage-audits/audit-sells',
                    'active' => 'admin/manage-audits/audit-sells*',
                    'slug' => 'view.audit.sells',
                ],
                [
                    'title' => 'Product Audit',
                    'link' => '/admin/manage-audits/product-audits',
                    'active' => 'admin/manage-audits/product-audits*',
                    'slug' => 'view.store.audit',
                ],
                [
                    'title' => 'Purchase Audit',
                    'link' => '/admin/manage-audits/purchase-audits',
                    'active' => 'admin/manage-audits/purchase-audits*',
                    'slug' => 'view.audit.purchase',
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
                    'title' => 'Banks',
                    'link' => '/admin/settings/banks',
                    'active' => 'admin/settings/banks*',
                    'slug' => 'view.banks',
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
