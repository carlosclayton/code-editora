<?php

return [
    'name' => 'CodeEduUser',
    'email' => [
        'user_created' => [
            'subject' => config('app.name') . ' - Sua conta foi criada'
        ]
    ],
    'middleware' => [
        'isVerified' => 'isVerified'
    ],
    'user_default' => [
        'name' => env('USER_NAME', 'Administrator'),
        'email' => env('USER_EMAIL', 'admin@admin.com'),
        'password' => env('USER_PASSWORD', '123456')
    ],
    'acl' => [
        'role_admin' => env('ROLE_ADMIN', 'Admin'),
        'role_description' => env('ROLE_DESCRIPTION', 'User administrator'),
        'controllers_annotations' =>
            '/../Http/controllers'

    ]
];
