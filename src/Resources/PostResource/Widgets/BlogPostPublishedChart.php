<?php

namespace FireFly\FilamentBlog\Resources\PostResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use FireFly\FilamentBlog\Models\Post;

class BlogPostPublishedChart extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            BaseWidget\Stat::make('Published', Post::published()->count())
                ->description('Post')
                ->descriptionIcon('heroicon-o-check-badge'),
            BaseWidget\Stat::make('Scheduled Post', Post::scheduled()->count())
                ->description('Post')
                ->descriptionIcon('heroicon-o-rocket-launch'),
            BaseWidget\Stat::make('Pending Post', Post::pending()->count())
                ->description('Post')
                ->descriptionIcon('heroicon-o-calendar-days'),
        ];
    }
}
