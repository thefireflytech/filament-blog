<?php

return [
    'route' => [
        'prefix' => 'blog',
        'middleware' => ['web'],
        'login' => [
            'name' => 'filament.admin.auth.login',
        ],
    ],
    'author' => [
        'model' => \App\Models\User::class,
        'photo_column' => false,
    ],
];
