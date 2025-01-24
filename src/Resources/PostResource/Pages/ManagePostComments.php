<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Resources\PostResource;
use Firefly\FilamentBlog\Tables\Columns\UserPhotoName;
use Illuminate\Contracts\Support\Htmlable;

class ManagePostComments extends ManageRelatedRecords
{
    protected static string $resource = PostResource::class;

    protected static string $relationship = 'comments';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public function getTitle(): string|Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return __('filament-blog::resources/posts.forms.tabs.edit_page.manage_comments');
    }

    public function getBreadcrumb(): string
    {
        return __('filament-blog::resources/posts.forms.tabs.edit_page.manage_comments');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-blog::resources/posts.forms.tabs.edit_page.manage_comments');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label(__('filament-blog::resources/comments.forms.fields.user'))
                    ->relationship('user', config('filamentblog.user.columns.name'))
                    ->required(),
                Textarea::make('comment')
                    ->label(__('filament-blog::resources/comments.forms.fields.comment'))
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Toggle::make('approved')
                    ->label(__('filament-blog::resources/comments.forms.fields.approved')),
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('comment')
                    ->label(__('filament-blog::resources/posts.tables.columns.comment'))
                    ->searchable(),
                UserPhotoName::make('user')
                    ->label(__('filament-blog::resources/posts.tables.columns.commented_by')),
                Tables\Columns\ToggleColumn::make('approved')
                    ->beforeStateUpdated(function ($record, $state) {
                        if ($state) {
                            $record->approved_at = now();
                        } else {
                            $record->approved_at = null;
                        }

                        return $state;
                    }),
                Tables\Columns\TextColumn::make('approved_at')
                    ->label(__('filament-blog::resources/posts.tables.columns.approved_at.label'))
                    ->placeholder(__('filament-blog::resources/posts.tables.columns.approved_at.placeholder'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(config('filamentblog.date_format') . ' ' . config('filamentblog.time_format'))
                    ->label(__('filament-blog::resources/general.created_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(config('filamentblog.date_format') . ' ' . config('filamentblog.time_format'))
                    ->label(__('filament-blog::resources/general.updated_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->label(__('filament-blog::resources/posts.tables.filters.user'))
                    ->relationship('user', config('filamentblog.user.columns.name'))
                    ->searchable()
                    ->preload()
                    ->multiple(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->label(__('filament-actions::create.single.label', ['label' => __('filament-blog::resources/comments.title')]))
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->modalHeading(__('filament-actions::edit.single.modal.heading', ['label' => __('filament-blog::resources/comments.title')])),
                    Tables\Actions\ViewAction::make()
                        ->modalHeading(__('filament-actions::view.single.modal.heading', ['label' => __('filament-blog::resources/comments.title')])),
                    Tables\Actions\DeleteAction::make()
                        ->modalHeading(__('filament-actions::delete.single.modal.heading', ['label' => __('filament-blog::resources/comments.title')])),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading(__('filament-actions::delete.multiple.modal.heading', ['label' => __('filament-blog::resources/comments.title')])),
                ]),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make(__('filament-blog::resources/posts.forms.sections.comment'))
                ->schema([
                    TextEntry::make('user.name')
                        ->label(__('filament-blog::resources/posts.tables.columns.commented_by')),
                    TextEntry::make('comment')
                        ->label(__('filament-blog::resources/posts.tables.columns.comment')),
                    TextEntry::make('created_at')
                        ->label(__('filament-blog::resources/general.created_at')),
                    TextEntry::make('approved_at')
                        ->label(__('filament-blog::resources/posts.tables.columns.approved_at.label'))
                        ->placeholder(__('filament-blog::resources/posts.tables.columns.approved_at.placeholder')),

                ])
                ->icon('heroicon-o-chat-bubble-left-ellipsis'),
        ]);
    }
}
