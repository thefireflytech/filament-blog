<?php

namespace FireFly\FilamentBlog\Resources\NewsletterResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use FireFly\FilamentBlog\Resources\NewsletterResource;

class CreateNewsletter extends CreateRecord
{
    protected static string $resource = NewsletterResource::class;
}
