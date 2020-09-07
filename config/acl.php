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
                'model'  => \Dnsoft\Acl\Models\Admin::class,
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
];
