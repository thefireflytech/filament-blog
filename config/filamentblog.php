<?php

return [
    'route' => [
        'prefix' => 'blog',
        'middleware' => ['web'],
    ],
    'user' => [
        'model' => \App\Models\User::class,
        'resource' => \App\Filament\UserResource::class,
        'photo_column' => 'profile_photo_path',
    ],
];
