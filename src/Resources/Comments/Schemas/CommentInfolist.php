<?php

namespace Firefly\FilamentBlog\Resources\Comments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Models\Post;

class CommentInfolist
{
    public static function configure(Schema $schema, ?Post $post = null): Schema
    {
        return $schema->components([
            Section::make(__('filament-blog.comment.comment'))
                ->columnSpanFull()
                ->schema([
                    TextEntry::make('user.name')
                        ->label(__('filament-blog.common.user'))
                        ->label('Commented by'),
                    TextEntry::make('post.title')
                        ->label(__('filament-blog.post.post'))
                        ->label('Post')
                        ->hidden(fn() => $post?->exists()),
                    TextEntry::make('comment')
                        ->label(__('filament-blog.comment.comment')),
                    TextEntry::make('created_at')
                        ->label(__('filament-blog.common.created_at')),
                    TextEntry::make('approved_at')
                        ->label(__('filament-blog.comment.approved_at'))
                        ->label('Approved At')
                        ->placeholder('Not Approved'),
                ])
                ->icon('heroicon-o-chat-bubble-left-ellipsis'),
        ]);
    }
}
