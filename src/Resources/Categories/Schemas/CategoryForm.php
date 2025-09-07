<?php

namespace Firefly\FilamentBlog\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->live(true)
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('slug', Str::slug($state));
                    })
                    ->unique(config('filamentblog.tables.prefix') . 'categories', 'name', null , true)
                    ->required()
                    ->maxLength(155),

                TextInput::make('slug')
                    ->unique(config('filamentblog.tables.prefix') . 'categories', 'slug', null, true)
                    ->readOnly()
                    ->maxLength(255),
            ]);
    }
}
