<?php

namespace Firefly\FilamentBlog\Resources\SeoDetails\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\SeoDetails\SeoDetailResource;

class ListSeoDetails extends ListRecords
{
    protected static string $resource = SeoDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
