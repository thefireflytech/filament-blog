<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Tag;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Tag::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-blog::resources/tags.tables.columns.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('filament-blog::resources/tags.tables.columns.slug')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-blog::resources/general.created_at'))
                    ->dateTime(config('filamentblog.date_format') . ' ' . config('filamentblog.time_format'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament-blog::resources/general.updated_at'))
                    ->dateTime(config('filamentblog.date_format') . ' ' . config('filamentblog.time_format'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => \Firefly\FilamentBlog\Resources\TagResource\Pages\ListTags::route('/'),
            'edit' => \Firefly\FilamentBlog\Resources\TagResource\Pages\EditTag::route('/{record}/edit'),
        ];
    }

    public static function getLabel() : ?string
    {
        return __('filament-blog::resources/tags.title');
    }

    public static function getPluralLabel() : ?string
    {
        return __('filament-blog::resources/tags.plural_title');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('filamentblog.group_navigation_title');
    }
}
