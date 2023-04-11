<?php

return [
    'auth' => [
        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admins',
            ],
        ],

        'providers' => [
            'admins' => [
                'driver' => 'eloquent',
                'model'  => \DnSoft\Acl\Models\Admin::class,
            ],
        ],

        'passwords' => [
            'admins' => [
                'provider' => 'admins',
                'table'    => 'admin_password_resets',
                'expire'   => 60,
                'throttle' => 60,
            ],
        ],
    ],
    'redirect_after_login' => function () {
        if (Route::has('admin.dashboard.index')) {
            return route('admin.dashboard.index');
        }
        return config('core.admin_prefix');
    },

    'redirect_after_logout' => function () {
        return route('admin.login');
    },

    'redirect_if_authenticated' => function () {
        if (Route::has('admin.dashboard.index')) {
            return route('admin.dashboard.index');
        }

        return config('core.admin_prefix');
    },
];
