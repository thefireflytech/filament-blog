<?php

namespace Firefly\FilamentBlog\Resources\Posts\Pages;

use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Resources\Posts\PostResource;
use Firefly\FilamentBlog\Resources\SeoDetails\Schemas\SeoDetailForm;
use Firefly\FilamentBlog\Resources\SeoDetails\Tables\SeoDetailsTable;

class ManagePostSeoDetail extends ManageRelatedRecords
{
    protected static string $resource = PostResource::class;

    protected static string $relationship = 'seoDetail';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-globe-alt';

    public function getTitle(): string
    {
        return 'Manage SEO Detail';
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage SEO Detail';
    }

    protected function canCreate(): bool
    {
        return ! $this->getRelationship()->count();
    }

    public function form(Schema $schema): Schema
    {
        return SeoDetailForm::configure($schema, $this->getRecord());
    }

    public function table(Table $table): Table
    {
        return SeoDetailsTable::configure($table, $this->getRecord());
    }
}
