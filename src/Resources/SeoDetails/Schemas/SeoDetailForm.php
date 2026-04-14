<?php

namespace Firefly\FilamentBlog\Resources\SeoDetails\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Resources\Posts\Schemas\PostForm;

class SeoDetailForm
{
    public static function configure(Schema $schema, ?Post $post = null): Schema
    {
        return $schema->components([
            Tabs::make('SEO & Social Settings')
                ->tabs([
                    Tab::make('General SEO')
                        ->schema([
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
                        ]),

                    Tab::make('Open Graph (Facebook/LinkedIn)')
                        ->schema([
                            TextInput::make('og_title')
                                ->label('OG Title')
                                ->maxLength(255)
                                ->hint('Leave blank to use the post title.'),
                            Textarea::make('og_description')
                                ->label('OG Description')
                                ->maxLength(255)
                                ->hint('Leave blank to use the post excerpt.'),
                            FileUpload::make('og_image')
                                ->label('OG Image')
                                ->visibility(config('filamentblog.filesystem.visibility', 'public'))
                                ->disk(config('filamentblog.filesystem.disk', 'public'))
                                ->directory('blog-og-images')
                                ->image()
                                ->preserveFilenames()
                                ->hint('Leave blank to use the default cover photo.'),
                        ]),

                    Tab::make('Twitter Card')
                        ->schema([
                            TextInput::make('twitter_title')
                                ->label('Twitter Title')
                                ->maxLength(255)
                                ->hint('Leave blank to use the post title.'),
                            Textarea::make('twitter_description')
                                ->label('Twitter Description')
                                ->maxLength(255)
                                ->hint('Leave blank to use the post excerpt.'),
                            FileUpload::make('twitter_image')
                                ->label('Twitter Image')
                                ->visibility(config('filamentblog.filesystem.visibility', 'public'))
                                ->disk(config('filamentblog.filesystem.disk', 'public'))
                                ->directory('blog-twitter-images')
                                ->image()
                                ->preserveFilenames()
                                ->hint('Leave blank to use the default cover photo.'),
                        ]),
                ])->columnSpanFull(),
        ]);
    }
}