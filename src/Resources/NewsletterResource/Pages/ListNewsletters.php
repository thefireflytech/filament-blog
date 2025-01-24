<?php

namespace Firefly\FilamentBlog\Resources\NewsletterResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\NewsletterResource;

class ListNewsletters extends ListRecords
{
    protected static string $resource = NewsletterResource::class;

    protected static ?string $title = '';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string {
        return __('filament-blog::resources/news_letters.list_title');
    }
}
