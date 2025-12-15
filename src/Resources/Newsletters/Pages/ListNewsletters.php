<?php

namespace Firefly\FilamentBlog\Resources\Newsletters\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\Newsletters\NewsletterResource;
use Illuminate\Contracts\Support\Htmlable;

class ListNewsletters extends ListRecords
{
    protected static string $resource = NewsletterResource::class;

    public function getTitle(): string|Htmlable
    {
        return __('filament-blog::resources.news_letter.newsletters_subscriber');
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
