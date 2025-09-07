<?php

namespace Firefly\FilamentBlog\Resources\SeoDetails\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Post;

class SeoDetailsTable
{
    public static function configure(Table $table, ?Post $post = null): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('post.title')
                    ->hidden(fn() => $post?->exists())
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
            ->recordActions([
                EditAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
