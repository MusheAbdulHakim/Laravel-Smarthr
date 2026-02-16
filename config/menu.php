<?php

return [
    [
        'title' => 'Main',
        'label' => 'Dashboard',
        'route' => 'dashboard',
        'icon' => 'dashboard',
        'order' => 1,
    ],
    [
        'label' => 'Apps',
        'icon' => 'cube',
        'order' => 2,
        'items' => [
            [
                'label' => 'Chat',
                'route' => 'app.chat',
            ],
        ],
    ],
    [
        'title' => 'Employees',
        'label' => 'Employees',
        'icon' => 'user',
        'order' => 3,
        'permissions' => ['view-employees', 'view-attendances', 'view-departments', 'view-designations', 'view-holidays'],
        'items' => [
            [
                'label' => 'Employees',
                'route' => 'employees.index',
                'permissions' => 'view-employees',
            ],
            [
                'label' => 'Attendance',
                'route' => 'attendances.index',
                'permissions' => 'view-attendances',
            ],
            [
                'label' => 'Departments',
                'route' => 'departments.index',
                'permissions' => 'view-departments',
            ],
            [
                'label' => 'Designations',
                'route' => 'designations.index',
                'permissions' => 'view-designations',
            ],
            [
                'label' => 'Holidays',
                'route' => 'holidays.index',
                'permissions' => 'view-holidays',
            ],
        ],
    ],
    [
        'label' => 'Clients',
        'route' => 'clients.index',
        'icon' => 'group',
        'order' => 4,
        'permission' => 'view-clients',
    ],
    [
        'label' => 'Tickets',
        'route' => 'tickets.index',
        'icon' => 'ticket',
        'order' => 5,
    ],
    [
        'label' => 'My Assigned Tickets',
        'route' => 'assigned-tickets',
        'icon' => 'ticket',
        'order' => 6,
    ],
    [
        'label' => 'Payroll',
        'icon' => 'money',
        'order' => 7,
        'permissions' => ['view-PayrollAllowances', 'view-PayrollDeductions', 'view-payrolls', 'view-payslips'],
        'items' => [
            [
                'label' => 'Payroll Items',
                'route' => 'payroll.items',
                'permissions' => ['view-PayrollAllowances', 'view-PayrollDeductions'],
            ],
            [
                'label' => 'Payslip',
                'route' => 'payslips.index',
                'permissions' => 'view-payslips',
            ],
        ],
    ],
    [
        'label' => 'Users',
        'route' => 'users.index',
        'icon' => 'user-plus',
        'order' => 8,
        'permissions' => 'view-users',
    ],
    [
        'label' => 'Backups',
        'route' => 'backups.index',
        'icon' => 'cloud-upload',
        'order' => 9,
        'permissions' => 'view-backups',
    ],
    [
        'label' => 'Assets',
        'route' => 'assets.index',
        'icon' => 'object-ungroup',
        'order' => 10,
        'permissions' => 'view-assets',
    ],
    [
        'label' => 'Settings',
        'route' => 'settings.index',
        'icon' => 'cog',
        'order' => 11,
        'permissions' => 'view-settings',
    ],
];
