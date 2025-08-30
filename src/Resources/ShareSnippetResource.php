<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Firefly\FilamentBlog\Resources\ShareSnippetResource\Pages\ListShareSnippets;
use Firefly\FilamentBlog\Resources\ShareSnippetResource\Pages\EditShareSnippet;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\ShareSnippet;

class ShareSnippetResource extends Resource
{
    protected static ?string $model = ShareSnippet::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-share';

    protected static string | \UnitEnum | null $navigationGroup = 'Blog';

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
        return $schema
            ->components(ShareSnippet::getform());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('script_code')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('html_code')
                    ->limit(50)
                    ->searchable(),
                ToggleColumn::make('active'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListShareSnippets::route('/'),
            'edit' => EditShareSnippet::route('/{record}/edit'),
        ];
    }
}
