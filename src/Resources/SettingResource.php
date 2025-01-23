<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Setting;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 8;

    public static function getLabel(): string
    {
        return __('filament-blog::settings.title');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-blog::settings.plural_title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Setting::getForm());
    }

    public static function canCreate(): bool
    {
        return Setting::count() === 0;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-blog::settings.table.columns.title'))
                    ->limit(25)
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('filament-blog::settings.table.columns.description'))
                    ->limit(30)
                    ->searchable(),

                Tables\Columns\ImageColumn::make('logo')
                    ->label(__('filament-blog::settings.table.columns.logo')),

                Tables\Columns\TextColumn::make('organization_name')
                    ->label(__('filament-blog::settings.table.columns.organization_name')),

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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => \Firefly\FilamentBlog\Resources\SettingResource\Pages\ListSettings::route('/'),
            'create' => \Firefly\FilamentBlog\Resources\SettingResource\Pages\CreateSetting::route('/create'),
            'edit' => \Firefly\FilamentBlog\Resources\SettingResource\Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
