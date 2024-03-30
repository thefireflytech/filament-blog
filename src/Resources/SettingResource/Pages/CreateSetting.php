<?php

namespace Firefly\FilamentBlog\Resources\SettingResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Firefly\FilamentBlog\Resources\SettingResource;

class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;

//    protected function beforeCreate(): void
//    {
//        dd($this->data);
//    }
}
