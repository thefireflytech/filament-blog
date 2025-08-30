<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Firefly\FilamentBlog\Resources\CommentResource\Pages\ListComments;
use Firefly\FilamentBlog\Resources\CommentResource\Pages\CreateComment;
use Firefly\FilamentBlog\Resources\CommentResource\Pages\EditComment;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Comment;
use Firefly\FilamentBlog\Tables\Columns\UserPhotoName;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static string | \UnitEnum | null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components(Comment::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                UserPhotoName::make('user')
                    ->label('User'),
                TextColumn::make('post.title')
                    ->numeric()
                    ->limit(20)
                    ->sortable(),
                TextColumn::make('comment')
                    ->searchable()
                    ->limit(20),
                ToggleColumn::make('approved')
                    ->beforeStateUpdated(function ($record, $state) {
                        if ($state) {
                            $record->approved_at = now();
                        } else {
                            $record->approved_at = null;
                        }

                        return $state;
                    }),
                TextColumn::make('approved_at')
                    ->sortable()
                    ->placeholder('Not approved yet'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('user')
                    ->relationship('user', config('filamentblog.user.columns.name'))
                    ->searchable()
                    ->preload()
                    ->multiple(),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                    ViewAction::make(),
                ]),
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
            'index' => ListComments::route('/'),
            'create' => CreateComment::route('/create'),
            'edit' => EditComment::route('/{record}/edit'),
        ];
    }
}
