<?php

namespace Firefly\FilamentBlog\Resources\ShareSnippetResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Firefly\FilamentBlog\Resources\ShareSnippetResource;

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
