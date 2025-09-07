<?php

namespace Firefly\FilamentBlog\Resources\ShareSnippets\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ShareSnippetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Textarea::make('script_code')
                ->label('JS Script')
                ->required(),
            Textarea::make('html_code')
                ->required(),
            Toggle::make('active'),
        ]);
    }
}
