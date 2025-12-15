<?php

namespace Firefly\FilamentBlog\Resources\Posts\Pages;

use Filament\Actions;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Firefly\FilamentBlog\Enums\PostStatus;
use Firefly\FilamentBlog\Resources\Posts\PostResource;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    public static function getNavigationLabel(): string
    {
        return __('filament-blog::resources.post.edit_post');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function beforeSave()
    {
        if ($this->data['status'] === PostStatus::PUBLISHED->value) {
            $this->record->published_at = $this->record->published_at ?? date('Y-m-d H:i:s');
        }
    }
}
