<?php

namespace Firefly\FilamentBlog\Resources\ShareSnippets\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Firefly\FilamentBlog\Resources\ShareSnippets\ShareSnippetResource;

class EditShareSnippet extends EditRecord
{
    protected static string $resource = ShareSnippetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
