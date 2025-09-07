<?php

namespace Firefly\FilamentBlog\Resources\ShareSnippets;

use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Resources\ShareSnippets\Schemas\ShareSnippetForm;
use Firefly\FilamentBlog\Resources\ShareSnippets\Pages\ListShareSnippets;
use Firefly\FilamentBlog\Resources\ShareSnippets\Pages\EditShareSnippet;
use Firefly\FilamentBlog\Resources\ShareSnippets\Tables\ShareSnippetsTable;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\ShareSnippet;
use BackedEnum;
use UnitEnum;

class ShareSnippetResource extends Resource
{
    protected static ?string $model = ShareSnippet::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-share';

    protected static string | UnitEnum | null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 7;

    public static function canCreate(): bool
    {
        return ! (self::$model::all()->count() > 0);
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return ShareSnippetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShareSnippetsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListShareSnippets::route('/'),
            'edit' => EditShareSnippet::route('/{record}/edit'),
        ];
    }
}
