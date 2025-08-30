<?php

namespace Firefly\FilamentBlog\Resources\Comments\Pages;

use Filament\Resources\Pages\CreateRecord;
use Firefly\FilamentBlog\Resources\Comments\CommentResource;

class CreateComment extends CreateRecord
{
    protected static string $resource = CommentResource::class;

    protected function afterCreate(): void
    {
        if($this->record->approved) {
            $this->record->approved_at = now();
            $this->record->save();
        }
    }
}
