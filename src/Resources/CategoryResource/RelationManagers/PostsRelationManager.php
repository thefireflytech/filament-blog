<?php

namespace Firefly\FilamentBlog\Resources\CategoryResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(Post::getForm());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-blog::posts.tables.columns.title'))
                    ->limit(40)
                    ->description(function (Post $record) {
                        return Str::limit($record->sub_title);
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament-blog::posts.tables.columns.status'))
                    ->badge()
                    ->color(function ($state) {
                        return $state->getColor();
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label(__('filament-actions::create.single.modal.heading', ['label' => __('filament-blog::posts.title')])),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->modalHeading(__('filament-actions::edit.single.modal.heading', ['label' => __('filament-blog::posts.title')])),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(__('filament-actions::delete.single.modal.heading', ['label' => __('filament-blog::posts.title')])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading(__('filament-actions::delete.multiple.modal.heading', ['label' => __('filament-blog::posts.title')])),
                ]),
            ]);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament-blog::posts.title');
    }

}
