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
                ->createOptionForm(fn(Schema $schema) => PostForm::configure($schema))
                ->editOptionForm(fn(Schema $schema) => PostForm::configure($schema))
                ->relationship('post', 'title')
                ->unique(config('filamentblog.tables.prefix').'seo_details', 'post_id', null, true)
                ->required()
                ->preload()
                ->searchable()
                ->default(request('post_id') ?? '')
                ->hidden(fn() => $post?->exists())
                ->columnSpanFull(),

            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
                
            TagsInput::make('keywords')
                ->columnSpanFull(),
                
            Textarea::make('description')
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
        ]);
    }
}