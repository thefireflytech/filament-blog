<?php

namespace Firefly\FilamentBlog\Resources\Comments\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Firefly\FilamentBlog\Resources\Comments\CommentResource;

class EditComment extends EditRecord
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        if ($this->record->approved) {
            $this->record->approved_at = now();
            $this->record->save();
        } else {
            $this->record->approved_at = null;
            $this->record->save();
        }
    }
}
