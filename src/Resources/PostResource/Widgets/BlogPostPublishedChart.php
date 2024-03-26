<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Firefly\FilamentBlog\Models\Post;

class BlogPostPublishedChart extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            BaseWidget\Stat::make('Published Post', Post::published()->count()),
            BaseWidget\Stat::make('Scheduled Post', Post::scheduled()->count()),
            BaseWidget\Stat::make('Pending Post', Post::pending()->count()),
        ];
    }
}
