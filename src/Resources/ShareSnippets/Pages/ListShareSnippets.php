<?php

namespace Firefly\FilamentBlog\Resources\ShareSnippets\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\ShareSnippets\ShareSnippetResource;
use Illuminate\Contracts\Support\Htmlable;

class ListShareSnippets extends ListRecords
{
    protected static string $resource = ShareSnippetResource::class;

    public function getSubheading(): string|Htmlable|null
    {
        return __('filament-blog::resources.share_snippet.share_snippet_help');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableDescription(): string|Htmlable|null
    {
        return __('filament-blog::resources.share_snippet.share_snippets');
    }
}
