<?php

namespace Firefly\FilamentBlog\Resources\Comments;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Comment;
use Firefly\FilamentBlog\Resources\Comments\Pages\CreateComment;
use Firefly\FilamentBlog\Resources\Comments\Pages\EditComment;
use Firefly\FilamentBlog\Resources\Comments\Pages\ListComments;
use Firefly\FilamentBlog\Resources\Comments\Schemas\CommentForm;
use Firefly\FilamentBlog\Resources\Comments\Schemas\CommentInfolist;
use Firefly\FilamentBlog\Resources\Comments\Tables\CommentsTable;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?int $navigationSort = 5;

    public static function getModelLabel(): string
    {
        return __('filament-blog.comment.comment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-blog.comment.comments');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-blog.blog');
    }

    public static function form(Schema $schema): Schema
    {
        return CommentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommentsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CommentInfolist::configure($schema);
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
