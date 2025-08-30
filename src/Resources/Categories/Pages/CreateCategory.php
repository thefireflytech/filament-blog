<?php

namespace Firefly\FilamentBlog\Resources\Categories\Pages;

use Filament\Resources\Pages\CreateRecord;
use Firefly\FilamentBlog\Resources\Categories\CategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
