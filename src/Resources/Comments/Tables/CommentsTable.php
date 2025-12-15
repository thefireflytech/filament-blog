<?php

namespace Firefly\FilamentBlog\Resources\Comments\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Tables\Columns\UserPhotoName;
use Firefly\FilamentBlog\Models\Post;

class CommentsTable
{
    public static function configure(Table $table, ?Post $post = null): Table
    {
        return $table
            ->columns([
                UserPhotoName::make('user')
                    ->label(__('filament-blog::resources.common.user')),
                TextColumn::make('post.title')
                    ->label(__('filament-blog::resources.post.post'))
                    ->hidden(fn() => $post?->exists())
                    ->limit(20)
                    ->sortable(),
                TextColumn::make('comment')
                    ->label(__('filament-blog::resources.comment.comment'))
                    ->searchable()
                    ->limit(20),
                ToggleColumn::make('approved')
                    ->label(__('filament-blog::resources.comment.approved'))
                    ->beforeStateUpdated(function ($record, $state) {
                        if ($state) {
                            $record->approved_at = now();
                        } else {
                            $record->approved_at = null;
                        }

                        return $state;
                    }),
                TextColumn::make('approved_at')
                    ->label(__('filament-blog::resources.comment.approved_at'))
                    ->sortable()
                    ->placeholder('Not approved yet'),

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
            ->filters([
                SelectFilter::make('user')
                    ->label(__('filament-blog::resources.common.user'))
                    ->relationship('user', config('filamentblog.user.columns.name'))
                    ->searchable()
                    ->preload()
                    ->multiple(),
                    
                SelectFilter::make('post')
                    ->label(__('filament-blog::resources.post.post'))
                    ->relationship('post', 'title')
                    ->searchable()
                    ->preload()
                    ->hidden(fn() => $post?->exists())
                    ->multiple(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
