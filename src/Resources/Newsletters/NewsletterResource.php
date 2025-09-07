<?php

namespace Firefly\FilamentBlog\Resources\Newsletters;

use BackedEnum;
use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Resources\Newsletters\Pages\ListNewsletters;
use Firefly\FilamentBlog\Resources\Newsletters\Pages\CreateNewsletter;
use Firefly\FilamentBlog\Resources\Newsletters\Pages\EditNewsletter;
use Firefly\FilamentBlog\Resources\Newsletters\Schemas\NewsletterForm;
use Firefly\FilamentBlog\Resources\Newsletters\Tables\NewslettersTable;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\NewsLetter;
use UnitEnum;

class NewsletterResource extends Resource
{
    protected static ?string $model = NewsLetter::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-newspaper';

    protected static string | UnitEnum | null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return NewsletterForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewslettersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNewsletters::route('/'),
            'create' => CreateNewsletter::route('/create'),
            'edit' => EditNewsletter::route('/{record}/edit'),
        ];
    }
}
