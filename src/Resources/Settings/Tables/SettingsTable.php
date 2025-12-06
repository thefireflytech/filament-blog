<?php

namespace Firefly\FilamentBlog\Resources\Settings\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament-blog::resources.common.title'))
                    ->limit(25)
                    ->searchable(),
                TextColumn::make('description')
                    ->label(__('filament-blog::resources.common.description'))
                    ->limit(30)
                    ->searchable(),

                ImageColumn::make('logo')
                    ->label(__('filament-blog::resources.setting.logo')),

                TextColumn::make('organization_name')
                    ->label(__('filament-blog::resources.setting.organization_name')),

                TextColumn::make('created_at')
                    ->label(__('filament-blog::resources.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament-blog::resources.common.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
