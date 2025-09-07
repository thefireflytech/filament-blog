<?php

/**
 * |--------------------------------------------------------------------------
 * | Set up your blog configuration
 * |--------------------------------------------------------------------------
 * |
 * | The route configuration is for setting up the route prefix and middleware.
 * | The user configuration is for setting up the user model and columns.
 * | The seo configuration is for setting up the default meta tags for the blog.
 * | The recaptcha configuration is for setting up the recaptcha for the blog.
 * | The filesystem configuration is for setting up the filesystem for the blog.
 */

use Firefly\FilamentBlog\Models\User;

return [
    /**
     * ------------------------------------------------------------
     * Tables
     * This is the prefix for all blog tables.
     * ------------------------------------------------------------
     */
    'tables' => [
        'prefix' => 'fblog_',
    ],

    /**
     * ------------------------------------------------------------
     * Route
     * This is the route configuration for the blog.
     * ------------------------------------------------------------
     */
    'route' => [
        'prefix' => 'blogs',
        'middleware' => ['web'],
        'home' => [
            'name' => 'filamentblog.home',
            'url' => env('APP_URL'),
        ],
        'login' => [
            'name' => 'filamentblog.post.login',
        ],
    ],

    /**
     * ------------------------------------------------------------
     * User
     * This is the user configuration for the blog.
     * ------------------------------------------------------------
     */
    'user' => [
        'model' => User::class,
        'foreign_key' => 'user_id',
        'columns' => [
            'name' => 'name',
            'avatar' => 'profile_photo_path',
        ],
    ],

    /**
     * ------------------------------------------------------------
     * SEO
     * This is the SEO configuration for the blog.
     * ------------------------------------------------------------
     */
    'seo' => [
        'meta' => [
            'title' => 'Filament Blog',
            'description' => 'This is filament blog seo meta description',
            'keywords' => [],
        ],
    ],

    /**
     * ------------------------------------------------------------
     * Recaptcha
     * This is the recaptcha configuration for the blog.
     * ------------------------------------------------------------
     */
    'recaptcha' => [
        'enabled' => false,
        'site_key' => env('RECAPTCHA_SITE_KEY'),
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    ],

    /**
     * ------------------------------------------------------------
     * Filesystem
     * This is the filesystem configuration for the blog.
     * ------------------------------------------------------------
     */
    'filesystem' => [
        'visibility' => 'public',
        'disk' => 'public',
    ],
];
