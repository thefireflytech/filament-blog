<?php

namespace Firefly\FilamentBlog\Resources\Settings\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Firefly\FilamentBlog\Resources\Settings\SettingResource;
use Firefly\FilamentBlog\Models\Setting;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn () => Setting::count() === 0),
        ];
    }
}
