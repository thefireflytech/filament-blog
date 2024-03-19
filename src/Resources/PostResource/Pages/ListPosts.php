<?php

namespace FireFly\FilamentBlog\Resources\PostResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use FireFly\FilamentBlog\Resources\PostResource;
use FireFly\FilamentBlog\Resources\PostResource\Widgets\BlogPostPublishedChart;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BlogPostPublishedChart::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Posts'),
            'published' => Tab::make('Published')
                ->modifyQueryUsing(function ($query) {
                    $query->published();
                }),
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(function ($query) {
                    $query->pending();
                }),
            'scheduled' => Tab::make('Scheduled')
                ->modifyQueryUsing(function ($query) {
                    $query->scheduled();
                }),
        ];
    }
}
