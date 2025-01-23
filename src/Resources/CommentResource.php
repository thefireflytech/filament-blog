<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Comment;
use Firefly\FilamentBlog\Tables\Columns\UserPhotoName;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Comment::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                UserPhotoName::make('user')
                    ->label(__('filament-blog::comments.tables.columns.user')),
                Tables\Columns\TextColumn::make('post.title')
                    ->label(__('filament-blog::comments.tables.columns.post'))
                    ->numeric()
                    ->limit(20)
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label(__('filament-blog::comments.tables.columns.comment'))
                    ->searchable()
                    ->limit(20),
                Tables\Columns\ToggleColumn::make('approved')
                    ->label(__('filament-blog::comments.tables.columns.approved'))
                    ->beforeStateUpdated(function ($record, $state) {
                        if ($state) {
                            $record->approved_at = now();
                        } else {
                            $record->approved_at = null;
                        }

                        return $state;
                    }),
                Tables\Columns\TextColumn::make('approved_at')
                    ->label(__('filament-blog::comments.tables.columns.approved_at.label'))
                    ->sortable()
                    ->placeholder(__('filament-blog::comments.tables.columns.approved_at.placeholder')),

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
                Tables\Filters\SelectFilter::make(__('filament-blog::comments.tables.filters.user'))
                    ->relationship('user', config('filamentblog.user.columns.name'))
                    ->searchable()
                    ->preload()
                    ->multiple(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
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
            'index' => \Firefly\FilamentBlog\Resources\CommentResource\Pages\ListComments::route('/'),
            'create' => \Firefly\FilamentBlog\Resources\CommentResource\Pages\CreateComment::route('/create'),
            'edit' => \Firefly\FilamentBlog\Resources\CommentResource\Pages\EditComment::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('filament-blog::comments.title');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-blog::comments.plural_title');
    }
}
