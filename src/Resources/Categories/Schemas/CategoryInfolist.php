<?php

namespace Firefly\FilamentBlog\Resources\Categories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('slug'),
                    ])
                    ->columns(2)
                    ->icon('heroicon-o-square-3-stack-3d'),
            ]);
    }
}
