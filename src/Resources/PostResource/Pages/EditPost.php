<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Pages;

use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Firefly\FilamentBlog\Enums\PostStatus;
use Firefly\FilamentBlog\Jobs\PostScheduleJob;
use Firefly\FilamentBlog\Resources\PostResource;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave()
    {
        if ($this->data['status'] === PostStatus::PUBLISHED->value) {
            $this->record->published_at = $this->record->published_at ?? date('Y-m-d H:i:s');
        }

        if($this->data['scheduled_for'] !== null) {
            $this->record->scheduled_for = $this->data['scheduled_for'];
        }
    }
}
