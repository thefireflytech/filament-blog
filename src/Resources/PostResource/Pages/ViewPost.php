<?php

namespace FireFly\FilamentBlog\Resources\PostResource\Pages;

use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use FireFly\FilamentBlog\Events\BlogPublished;
use FireFly\FilamentBlog\Models\Post;
use FireFly\FilamentBlog\Resources\PostResource;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sendNotification')
                ->label('Send Notification')
                ->requiresConfirmation()
                ->icon('heroicon-o-bell')->action(function (Post $record) {
                    event(new BlogPublished($record));
                }),
        ];
    }
}
