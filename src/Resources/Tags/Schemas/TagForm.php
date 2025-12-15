<?php

namespace Firefly\FilamentBlog\Resources\Tags\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label(__('filament-blog::resources.common.name'))
                ->live(true)
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->unique(config('filamentblog.tables.prefix') . 'tags', 'name', null, true)
                ->required()
                ->maxLength(50),

            TextInput::make('slug')
                ->label(__('filament-blog::resources.common.slug'))
                ->unique(config('filamentblog.tables.prefix') . 'tags', 'slug', null, true)
                ->readOnly()
                ->maxLength(155),
        ]);
    }
}
