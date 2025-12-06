<?php

namespace Firefly\FilamentBlog\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Enums\PostStatus;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Resources\Categories\Schemas\CategoryForm;
use Firefly\FilamentBlog\Resources\Tags\Schemas\TagForm;
use Firefly\FilamentBlog\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema, ?Category $category = null, ?Tag $tag = null): Schema
    {
        return $schema->components([
            Section::make(__('filament-blog::resources.post.blog_details'))
                ->columnSpanFull()
                ->schema([
                    Fieldset::make(__('filament-blog::resources.common.titles'))
                        ->schema([
                            Select::make('category_id')
                                ->label(__('filament-blog::resources.category.categories'))
                                ->hidden(fn() => $category?->exists())
                                ->multiple()
                                ->preload()
                                ->createOptionForm(fn(Schema $schema) => CategoryForm::configure($schema))
                                ->searchable()
                                ->relationship('categories', 'name')
                                ->columnSpanFull(),

                            TextInput::make('title')
                                ->label(__('filament-blog::resources.common.title'))
                                ->live(true)
                                ->afterStateUpdated(fn(Set $set, ?string $state) => $set(
                                    'slug',
                                    Str::slug($state)
                                ))
                                ->required()
                                ->unique(config('filamentblog.tables.prefix') . 'posts', 'title', null, true)
                                ->maxLength(255),

                            TextInput::make('slug')
                                ->label(__('filament-blog::resources.common.slug'))
                                ->required()
                                ->unique(config('filamentblog.tables.prefix') . 'posts', 'slug', null, true)
                                ->maxLength(255),

                            Textarea::make('sub_title')
                                ->label(__('filament-blog::resources.post.sub_title'))
                                ->maxLength(255)
                                ->columnSpanFull(),

                            Select::make('tag_id')
                                ->label(__('filament-blog::resources.tag.tags'))
                                ->hidden(fn() => $tag?->exists())
                                ->multiple()
                                ->preload()
                                ->createOptionForm(fn(Schema $schema) => TagForm::configure($schema))
                                ->searchable()
                                ->relationship('tags', 'name')
                                ->columnSpanFull(),
                        ]),

                    RichEditor::make('body')
                        ->label(__('filament-blog::resources.post.body'))
                        ->extraInputAttributes(['style' => 'min-height: 24rem'])
                        ->required()
                        ->columnSpanFull(),

                    Fieldset::make(__('filament-blog::resources.post.feature_image'))
                        ->schema([
                            FileUpload::make('cover_photo_path')
                                ->label(__('filament-blog::resources.post.cover_photo'))
                                ->visibility(config('filamentblog.filesystem.visibility', 'public'))
                                ->disk(config('filamentblog.filesystem.disk', 'public'))
                                ->label('Cover Photo')
                                ->directory('/blog-feature-images')
                                ->hint('This cover image is used in your blog post as a feature image. Recommended image size 1200 X 628')
                                ->image()
                                ->preserveFilenames()
                                ->imageEditor()
                                ->maxSize(1024 * 5)
                                ->rules('dimensions:max_width=1920,max_height=1004')
                                ->required(),
                            TextInput::make('photo_alt_text')
                                ->label(__('filament-blog::resources.post.photo_alt_text'))
                                ->required(),
                        ])->columns(1),

                    Fieldset::make(__('filament-blog::resources.post.status'))
                        ->schema([
                            ToggleButtons::make('status')
                                ->live()
                                ->label(__('filament-blog::resources.post.status'))
                                ->inline()
                                ->options(PostStatus::class)
                                ->required(),

                            DateTimePicker::make('scheduled_for')
                                ->label(__('filament-blog::resources.post.scheduled_for'))
                                ->visible(function ($get) {
                                    return $get('status') === PostStatus::SCHEDULED;
                                })
                                ->required(function ($get) {
                                    return $get('status') === PostStatus::SCHEDULED;
                                })
                                ->minDate(now()->addMinutes(5))
                                ->native(false),
                        ]),
                    Select::make(config('filamentblog.user.foreign_key'))
                        ->label(__('filament-blog::resources.post.author'))
                        ->relationship('user', config('filamentblog.user.columns.name'))
                        ->nullable(false)
                        ->default(Auth::id()),

                ]),
        ]);
    }
}
