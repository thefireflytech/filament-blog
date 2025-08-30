<?php

namespace Firefly\FilamentBlog\Resources\Comments\Pages;

use Filament\Actions\CreateAction;
    use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\Comments\CommentResource;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
