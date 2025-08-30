<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Pages;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\CreateAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
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

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public function getTitle(): string|Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return 'Manage Comments';
    }

    public function getBreadcrumb(): string
    {
        return 'Comments';
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Comments';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', config('filamentblog.user.columns.name'))
                    ->required(),
                Textarea::make('comment')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Toggle::make('approved'),
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('comment')
                    ->searchable(),
                UserPhotoName::make('user')
                    ->label('Commented By'),
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
                    ->placeholder('Not approved')
                    ->sortable(),

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
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Comment')
                ->schema([
                    TextEntry::make('user.name')
                        ->label('Commented by'),
                    TextEntry::make('comment'),
                    TextEntry::make('created_at'),
                    TextEntry::make('approved_at')->label('Approved At')->placeholder('Not Approved'),

                ])
                ->icon('heroicon-o-chat-bubble-left-ellipsis'),
        ]);
    }
}
