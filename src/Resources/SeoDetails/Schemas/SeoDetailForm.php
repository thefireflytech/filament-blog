<?php

namespace Firefly\FilamentBlog\Resources\SeoDetails\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Resources\Posts\Schemas\PostForm;

class SeoDetailForm
{
    public static function configure(Schema $schema, ?Post $post = null): Schema
    {
        return $schema->components([
            Select::make('post_id')
                ->label(__('filament-blog::resources.post.post'))
                ->createOptionForm(fn(Schema $schema) => PostForm::configure($schema))
                ->editOptionForm(fn(Schema $schema) => PostForm::configure($schema))
                ->relationship('post', 'title')
                ->unique(config('filamentblog.tables.prefix') . 'seo_details', 'post_id', null, true)
                ->required()
                ->preload()
                ->searchable()
                ->default(request('post_id') ?? '')
                ->hidden(fn() => $post?->exists())
                ->columnSpanFull(),

            TextInput::make('title')
                ->label(__('filament-blog::resources.common.title'))
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            TagsInput::make('keywords')
                ->label(__('filament-blog::resources.seo.keywords'))
                ->columnSpanFull(),

            Textarea::make('description')
                ->label(__('filament-blog::resources.common.description'))
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
        ]);
    }
}