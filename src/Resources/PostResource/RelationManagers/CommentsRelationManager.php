<?php

namespace Firefly\FilamentBlog\Resources\PostResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('comment')
                    ->label(__('filament-blog::resources/comments.forms.fields.comment'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('comment')
            ->columns([
                Tables\Columns\TextColumn::make('comment')->limit(20),
                Tables\Columns\TextColumn::make('user.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalHeading(__('filament-actions::delete.single.modal.heading', ['label' => __('filament-blog::resources/comments.title')])),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(__('filament-actions::edit.single.modal.heading', ['label' => __('filament-blog::resources/comments.title')])),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(__('filament-actions::delete.single.modal.heading', ['label' => __('filament-blog::resources/comments.title')])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
