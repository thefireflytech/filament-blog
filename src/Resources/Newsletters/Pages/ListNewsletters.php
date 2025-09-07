<?php

namespace Firefly\FilamentBlog\Resources\Newsletters\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\Newsletters\NewsletterResource;

class ListNewsletters extends ListRecords
{
    protected static string $resource = NewsletterResource::class;

    protected static ?string $title = 'Newsletters Subscriber';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
