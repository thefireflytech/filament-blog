<?php

namespace Firefly\FilamentBlog\Resources\Categories;

use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Resources\Categories\Pages\EditCategory;
use Firefly\FilamentBlog\Resources\Categories\Pages\ListCategories;
use Firefly\FilamentBlog\Resources\Categories\Pages\ViewCategory;
use Firefly\FilamentBlog\Resources\Categories\Schemas\CategoryForm;
use Firefly\FilamentBlog\Resources\Categories\Schemas\CategoryInfolist;
use Firefly\FilamentBlog\Resources\Categories\Tables\CategoriesTable;
use Firefly\FilamentBlog\Resources\Categories\RelationManagers\PostsRelationManager;
use UnitEnum;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-squares-plus';

    protected static string | UnitEnum | null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CategoryInfolist::configure($schema);
    }

    public static function getRelations(): array
    {
        return [
            PostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategories::route('/'),
            'edit' => EditCategory::route('/{record}/edit'),
            'view' => ViewCategory::route('/{record}'),
        ];
    }
}
