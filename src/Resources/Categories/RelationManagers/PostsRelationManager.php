<?php

namespace Firefly\FilamentBlog\Resources\Categories\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Resources\Posts\Schemas\PostForm;
use Firefly\FilamentBlog\Resources\Posts\Schemas\PostInfolist;
use Firefly\FilamentBlog\Resources\Posts\Tables\PostsTable;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function infolist(Schema $schema): Schema
    {
        return PostInfolist::configure($schema, $this->getOwnerRecord());
    }

    public function form(Schema $schema): Schema
    {
        return PostForm::configure($schema, $this->getOwnerRecord());
    }

    public function table(Table $table): Table
    {
        return PostsTable::configure($table);
    }
}
