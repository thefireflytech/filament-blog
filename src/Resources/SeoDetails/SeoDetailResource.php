<?php

namespace Firefly\FilamentBlog\Resources\SeoDetails;

use BackedEnum;
use UnitEnum;
use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Resources\SeoDetails\Pages\ListSeoDetails;
use Firefly\FilamentBlog\Resources\SeoDetails\Pages\CreateSeoDetail;
use Firefly\FilamentBlog\Resources\SeoDetails\Pages\EditSeoDetail;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\SeoDetail;
use Firefly\FilamentBlog\Resources\SeoDetails\Schemas\SeoDetailForm;
use Firefly\FilamentBlog\Resources\SeoDetails\Tables\SeoDetailsTable;

class SeoDetailResource extends Resource
{
    protected static ?string $model = SeoDetail::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static string | UnitEnum | null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return SeoDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeoDetailsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSeoDetails::route('/'),
            'create' => CreateSeoDetail::route('/create'),
            'edit' => EditSeoDetail::route('/{record}/edit'),
        ];
    }
}
