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
            'designation' => 'designation',
            'bio' => 'bio',
        ],
    ],

    /**
     * ------------------------------------------------------------
     * Blog Feature Image
     */
    'blog_image' => [
        'directory' => '/blog-feature-images',
        'cover_aspect_ratio' => env('FILAMENT_BLOG_COVER_ASPECT_RATIO', '1.91:1'),
        'auto_open_editor' => env('FILAMENT_BLOG_AUTO_OPEN_EDITOR', true),
        'max_size' => 1024 * 5, // 5MB
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
     * Post Rendering Options
     * Configure how the blog post body is processed and displayed.
     */
    'post_rendering' => [
        'table_of_content' => [
            'enabled' => false,
            'title' => false, // Whether to include the manual post title as first TOC entry

        ],
        'show_author' => env('FILAMENT_BLOG_SHOW_AUTHOR', true),
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
