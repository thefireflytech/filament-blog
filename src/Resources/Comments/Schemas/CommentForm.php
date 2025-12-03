<?php

namespace Firefly\FilamentBlog\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Models\Post;

class CommentForm
{
    public static function configure(Schema $schema, ?Post $post = null): Schema
    {
        return $schema->components([
            Select::make('user_id')
                ->label(__('filament-blog.common.user'))
                ->relationship('user', config('filamentblog.user.columns.name'))
                ->required(),
            Select::make('post_id')
                ->label(__('filament-blog.post.post'))
                ->relationship('post', 'title')
                ->hidden(fn() => $post?->exists())
                ->required(),
            Textarea::make('comment')
                ->label(__('filament-blog.comment.comment'))
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
            Toggle::make('approved')
                ->label(__('filament-blog.comment.approved')),
        ]);
    }
}
