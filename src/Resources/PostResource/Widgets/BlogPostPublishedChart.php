<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Firefly\FilamentBlog\Models\Post;

class BlogPostPublishedChart extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            BaseWidget\Stat::make(__('filament-blog::posts.forms.widget.cards.published_post'), Post::published()->count()),
            BaseWidget\Stat::make(__('filament-blog::posts.forms.widget.cards.scheduled_post'), Post::scheduled()->count()),
            BaseWidget\Stat::make(__('filament-blog::posts.forms.widget.cards.pending_post'), Post::pending()->count()),
        ];
    }
}
