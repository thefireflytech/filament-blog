<?php

namespace Firefly\FilamentBlog\Resources\ShareSnippetResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\ShareSnippetResource;
use Illuminate\Contracts\Support\Htmlable;

class ListShareSnippets extends ListRecords
{
    protected static string $resource = ShareSnippetResource::class;

    protected ?string $subheading = 'Please visit https://platform.sharethis.com to get the script code and html code for sharing snippets';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableDescription(): string|Htmlable|null
    {
        return 'Share Snippets';
    }
}
