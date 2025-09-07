<?php

namespace Firefly\FilamentBlog\Resources\Posts;

use BackedEnum;
use Filament\Pages\Enums\SubNavigationPosition;
use UnitEnum;
use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Resources\Posts\Pages\ListPosts;
use Firefly\FilamentBlog\Resources\Posts\Pages\CreatePost;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Resources\Posts\Pages\EditPost;
use Firefly\FilamentBlog\Resources\Posts\Pages\ManagePostSeoDetail;
use Firefly\FilamentBlog\Resources\Posts\Pages\ManagePostComments;
use Firefly\FilamentBlog\Resources\Posts\Pages\ViewPost;
use Firefly\FilamentBlog\Resources\Posts\Schemas\PostForm;
use Firefly\FilamentBlog\Resources\Posts\Schemas\PostInfolist;
use Firefly\FilamentBlog\Resources\Posts\Tables\PostsTable;
use Firefly\FilamentBlog\Resources\Posts\Widgets\BlogPostPublishedChart;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-minus';

    protected static string | UnitEnum | null $navigationGroup = 'Blog';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 3;

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getNavigationBadge(): ?string
    {
        return strval(Post::count());
    }

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PostInfolist::configure($schema);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewPost::class,
            ManagePostSeoDetail::class,
            ManagePostComments::class,
            EditPost::class,
        ]);
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
            'seoDetail' => ManagePostSeoDetail::route('/{record}/seo-details'),
        ];
    }
}
