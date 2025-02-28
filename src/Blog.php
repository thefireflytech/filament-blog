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
        $enabledResources = [
            Resources\CategoryResource::class,
            Resources\PostResource::class,
            Resources\TagResource::class,
            Resources\SettingResource::class,
        ];

        if (config('filamentblog.features.comment.enabled')) {
            $enabledResources[] = Resources\CommentResource::class;
        }
        if (config('filamentblog.features.newsletter.enabled')) {
            $enabledResources[] = Resources\NewsletterResource::class;
        }
        if (config('filamentblog.features.seo_details.enabled')) {
            $enabledResources[] = Resources\SeoDetailResource::class;
        }
        if (config('filamentblog.features.share_code.enabled')) {
            $enabledResources[] = Resources\ShareSnippetResource::class;
        }

        $panel->resources($enabledResources);
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
