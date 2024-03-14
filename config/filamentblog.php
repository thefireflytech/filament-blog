<?php

return [
    'route' => [
        'prefix' => 'blog',
        'middleware' => ['web'],
    ],
    'author' => [
        'model' => \App\Models\User::class,
        'photo_column' => false,
    ],
];
