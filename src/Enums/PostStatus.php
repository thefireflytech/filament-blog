<?php

namespace Firefly\FilamentBlog\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PostStatus: string implements HasColor, HasIcon, HasLabel
{
    case PENDING = 'pending';
    case SCHEDULED = 'scheduled';
    case PUBLISHED = 'published';

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::SCHEDULED => 'primary',
            self::PUBLISHED => 'success'
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::SCHEDULED => 'Scheduled',
            self::PUBLISHED => 'Published'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDING => 'heroicon-o-calendar-days',
            self::SCHEDULED => 'heroicon-o-rocket-launch',
            self::PUBLISHED => 'heroicon-o-check-badge',
        };
    }
}
