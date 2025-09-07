<?php

namespace Firefly\FilamentBlog\Resources\Newsletters\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NewsletterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(100),
            Toggle::make('subscribed')
                ->default(true)
                ->required()->columnSpanFull(),
        ])->columns(2);
    }
}
