<?php

namespace Firefly\FilamentBlog\Resources\Posts\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Firefly\FilamentBlog\Models\Post;

class BlogPostPublishedChart extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            BaseWidget\Stat::make(__('filament-blog.post.published_post'), Post::published()->count()),
            BaseWidget\Stat::make(__('filament-blog.post.scheduled_post'), Post::scheduled()->count()),
            BaseWidget\Stat::make(__('filament-blog.post.pending_post'), Post::pending()->count()),
        ];
    }
}
