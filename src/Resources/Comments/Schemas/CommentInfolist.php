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
            Section::make('Comment')
                ->columnSpanFull()
                ->schema([
                    TextEntry::make('user.name')
                        ->label('Commented by'),
                    TextEntry::make('post.title')
                        ->label('Post')
                        ->hidden(fn() => $post?->exists()),
                    TextEntry::make('comment'),
                    TextEntry::make('created_at'),
                    TextEntry::make('approved_at')
                        ->label('Approved At')
                        ->placeholder('Not Approved'),
                ])
                ->icon('heroicon-o-chat-bubble-left-ellipsis'),
        ]);
    }
}
