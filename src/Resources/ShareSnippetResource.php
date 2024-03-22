<?php

namespace FireFly\FilamentBlog\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FireFly\FilamentBlog\Models\ShareSnippet;

class ShareSnippetResource extends Resource
{
    protected static ?string $model = ShareSnippet::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';

    protected static ?string $navigationGroup = 'Blog Group';

    public static function canCreate(): bool
    {
        return ! (self::$model::all()->count() > 0);

    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(ShareSnippet::getform());
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
                Tables\Columns\ToggleColumn::make('active'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => \FireFly\FilamentBlog\Resources\ShareSnippetResource\Pages\ListShareSnippets::route('/'),
            'edit' => \FireFly\FilamentBlog\Resources\ShareSnippetResource\Pages\EditShareSnippet::route('/{record}/edit'),
        ];
    }
}
