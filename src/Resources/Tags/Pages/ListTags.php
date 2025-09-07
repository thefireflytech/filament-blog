<?php

namespace Firefly\FilamentBlog\Resources\Tags\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\Tags\TagResource;

class ListTags extends ListRecords
{
    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
