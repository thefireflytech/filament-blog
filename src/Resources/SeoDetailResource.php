<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Firefly\FilamentBlog\Resources\SeoDetailResource\Pages\ListSeoDetails;
use Firefly\FilamentBlog\Resources\SeoDetailResource\Pages\CreateSeoDetail;
use Firefly\FilamentBlog\Resources\SeoDetailResource\Pages\EditSeoDetail;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\SeoDetail;

class SeoDetailResource extends Resource
{
    protected static ?string $model = SeoDetail::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static string | \UnitEnum | null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components(SeoDetail::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('post.title')
                    ->limit(20),
                TextColumn::make('title')
                    ->limit(20)
                    ->searchable(),
                TextColumn::make('keywords')->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
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
            'index' => ListSeoDetails::route('/'),
            'create' => CreateSeoDetail::route('/create'),
            'edit' => EditSeoDetail::route('/{record}/edit'),
        ];
    }
}
