<?php

namespace Firefly\FilamentBlog;

use Filament\Contracts\Plugin;
use Filament\Panel;

class Blog implements Plugin
{
    public static function make()
    {
        return new static();
    }

    public function getId(): string
    {
        return 'filament-blog';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            Resources\CategoryResource::class,
            Resources\PostResource::class,
            Resources\TagResource::class,
            Resources\SeoDetailResource::class,
            Resources\NewsletterResource::class,
            Resources\CommentResource::class,
            Resources\ShareSnippetResource::class,
            Resources\SettingResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
