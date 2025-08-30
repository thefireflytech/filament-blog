<?php

namespace Firefly\FilamentBlog;

use Firefly\FilamentBlog\Resources\Categories\CategoryResource;
use Firefly\FilamentBlog\Resources\Posts\PostResource;
use Firefly\FilamentBlog\Resources\Tags\TagResource;
use Firefly\FilamentBlog\Resources\SeoDetails\SeoDetailResource;
use Firefly\FilamentBlog\Resources\Newsletters\NewsletterResource;
use Firefly\FilamentBlog\Resources\Comments\CommentResource;
use Firefly\FilamentBlog\Resources\ShareSnippets\ShareSnippetResource;
use Firefly\FilamentBlog\Resources\Settings\SettingResource;
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
            CategoryResource::class,
            PostResource::class,
            TagResource::class,
            SeoDetailResource::class,
            NewsletterResource::class,
            CommentResource::class,
            ShareSnippetResource::class,
            SettingResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
