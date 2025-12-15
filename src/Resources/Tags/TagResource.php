<?php

namespace Firefly\FilamentBlog\Resources\Tags;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Tag;
use Firefly\FilamentBlog\Resources\Tags\Pages\EditTag;
use Firefly\FilamentBlog\Resources\Tags\Pages\ListTags;
use Firefly\FilamentBlog\Resources\Tags\Schemas\TagForm;
use Firefly\FilamentBlog\Resources\Tags\Tables\TagsTable;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    public static function getModelLabel(): string
    {
        return __('filament-blog::resources.tag.tag');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-blog::resources.tag.tags');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-blog::resources.blog');
    }

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return TagForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TagsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTags::route('/'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }
}
