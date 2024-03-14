<?php

return [
    'route' => [
        'prefix' => 'blog',
        'middleware' => ['web'],
    ],
    'author' => [
        'model' => \App\Models\User::class,
        'resource' => [
            'name' => \App\Filament\UserResource::class,
            'label' => 'Users',
        ],
        'photo_column' => 'profile_photo_path',
    ],
];
