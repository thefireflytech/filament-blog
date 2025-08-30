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
use Firefly\FilamentBlog\Resources\Categories\Schemas\CategoryForm;
use Firefly\FilamentBlog\Resources\Tags\Schemas\TagForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Blog Details')
                ->columnSpanFull()
                ->schema([
                    Fieldset::make('Titles')
                        ->schema([
                            Select::make('category_id')
                                ->multiple()
                                ->preload()
                                ->createOptionForm(fn(Schema $schema) => CategoryForm::configure($schema))
                                ->searchable()
                                ->relationship('categories', 'name')
                                ->columnSpanFull(),

                            TextInput::make('title')
                                ->live(true)
                                ->afterStateUpdated(fn(Set $set, ?string $state) => $set(
                                    'slug',
                                    Str::slug($state)
                                ))
                                ->required()
                                ->unique(config('filamentblog.tables.prefix') . 'posts', 'title', null, true)
                                ->maxLength(255),

                            TextInput::make('slug')
                                ->required()
                                ->unique(config('filamentblog.tables.prefix') . 'posts', 'slug', null, true)
                                ->maxLength(255),

                            Textarea::make('sub_title')
                                ->maxLength(255)
                                ->columnSpanFull(),

                            Select::make('tag_id')
                                ->multiple()
                                ->preload()
                                ->createOptionForm(fn(Schema $schema) => TagForm::configure($schema))
                                ->searchable()
                                ->relationship('tags', 'name')
                                ->columnSpanFull(),
                        ]),

                    RichEditor::make('body')
                        ->extraInputAttributes(['style' => 'max-height: 30rem; min-height: 24rem'])
                        ->required()
                        ->columnSpanFull(),

                    Fieldset::make('Feature Image')
                        ->schema([
                            FileUpload::make('cover_photo_path')
                                ->label('Cover Photo')
                                ->directory('/blog-feature-images')
                                ->hint('This cover image is used in your blog post as a feature image. Recommended image size 1200 X 628')
                                ->image()
                                ->preserveFilenames()
                                ->imageEditor()
                                ->maxSize(1024 * 5)
                                ->rules('dimensions:max_width=1920,max_height=1004')
                                ->required(),
                            TextInput::make('photo_alt_text')->required(),
                        ])->columns(1),

                    Fieldset::make('Status')
                        ->schema([
                            ToggleButtons::make('status')
                                ->live()
                                ->inline()
                                ->options(PostStatus::class)
                                ->required(),

                            DateTimePicker::make('scheduled_for')
                                ->visible(function ($get) {
                                    return $get('status') === PostStatus::SCHEDULED->value;
                                })
                                ->required(function ($get) {
                                    return $get('status') === PostStatus::SCHEDULED->value;
                                })
                                ->minDate(now()->addMinutes(5))
                                ->native(false),
                        ]),
                    Select::make(config('filamentblog.user.foreign_key'))
                        ->relationship('user', config('filamentblog.user.columns.name'))
                        ->nullable(false)
                        ->default(Auth::id()),

                ]),
        ]);
    }
}
