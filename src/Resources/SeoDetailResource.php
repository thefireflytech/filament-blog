<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\SeoDetail;

class SeoDetailResource extends Resource
{
    protected static ?string $model = SeoDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(SeoDetail::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('post.title')
                    ->label(__('filament-blog::seo_details.tables.columns.post'))
                    ->limit(20),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-blog::seo_details.tables.columns.title'))
                    ->limit(20)
                    ->searchable(),
                Tables\Columns\TextColumn::make('keywords')
                    ->badge()
                    ->label(__('filament-blog::seo_details.tables.columns.keywords'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-blog::general.created_at'))
                    ->dateTime(config('filamentblog.date_format') . ' ' . config('filamentblog.time_format'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament-blog::general.updated_at'))
                    ->dateTime(config('filamentblog.date_format') . ' ' . config('filamentblog.time_format'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
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
            'index' => \Firefly\FilamentBlog\Resources\SeoDetailResource\Pages\ListSeoDetails::route('/'),
            'create' => \Firefly\FilamentBlog\Resources\SeoDetailResource\Pages\CreateSeoDetail::route('/create'),
            'edit' => \Firefly\FilamentBlog\Resources\SeoDetailResource\Pages\EditSeoDetail::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('filament-blog::seo_details.title');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-blog::seo_details.plural_title');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('filamentblog.group_navigation_title');
    }
}
