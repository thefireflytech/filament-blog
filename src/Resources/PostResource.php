<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Fieldset;
use Firefly\FilamentBlog\Resources\PostResource\Pages\ListPosts;
use Firefly\FilamentBlog\Resources\PostResource\Pages\CreatePost;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Enums\PostStatus;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Resources\PostResource\Pages\EditPost;
use Firefly\FilamentBlog\Resources\PostResource\Pages\ManaePostSeoDetail;
use Firefly\FilamentBlog\Resources\PostResource\Pages\ManagePostComments;
use Firefly\FilamentBlog\Resources\PostResource\Pages\ViewPost;
use Firefly\FilamentBlog\Resources\PostResource\Widgets\BlogPostPublishedChart;
use Firefly\FilamentBlog\Tables\Columns\UserPhotoName;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-minus';

    protected static string | \UnitEnum | null $navigationGroup = 'Blog';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 3;

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getNavigationBadge(): ?string
    {
        return strval(Post::count());
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components(Post::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->columns([
                TextColumn::make('title')
                    ->description(function (Post $record) {
                        return Str::limit($record->sub_title, 40);
                    })
                    ->searchable()->limit(20),
                TextColumn::make('status')
                    ->badge()
                    ->color(function ($state) {
                        return $state->getColor();
                    }),
                ImageColumn::make('cover_photo_path')->label('Cover Photo'),

                UserPhotoName::make('user')
                    ->label('Author'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('id', 'desc')
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
                    ViewAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Post')
                ->schema([
                    Fieldset::make('General')
                        ->schema([
                            TextEntry::make('title'),
                            TextEntry::make('slug'),
                            TextEntry::make('sub_title'),
                        ]),
                    Fieldset::make('Publish Information')
                        ->schema([
                            TextEntry::make('status')
                                ->badge()->color(function ($state) {
                                    return $state->getColor();
                                }),
                            TextEntry::make('published_at')->visible(function (Post $record) {
                                return $record->status === PostStatus::PUBLISHED;
                            }),

                            TextEntry::make('scheduled_for')->visible(function (Post $record) {
                                return $record->status === PostStatus::SCHEDULED;
                            }),
                        ]),
                    Fieldset::make('Description')
                        ->schema([
                            TextEntry::make('body')
                                ->html()
                                ->columnSpanFull(),
                        ]),
                ]),
        ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewPost::class,
            ManaePostSeoDetail::class,
            ManagePostComments::class,
            EditPost::class,
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //            \Firefly\FilamentBlog\Resources\PostResource\RelationManagers\SeoDetailRelationManager::class,
            //            \Firefly\FilamentBlog\Resources\PostResource\RelationManagers\CommentsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            BlogPostPublishedChart::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
            'view' => ViewPost::route('/{record}'),
            'comments' => ManagePostComments::route('/{record}/comments'),
            'seoDetail' => ManaePostSeoDetail::route('/{record}/seo-details'),
        ];
    }
}
