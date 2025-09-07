<?php

namespace Firefly\FilamentBlog\Resources\SeoDetails\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Firefly\FilamentBlog\Resources\SeoDetails\SeoDetailResource;

class EditSeoDetail extends EditRecord
{
    protected static string $resource = SeoDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
