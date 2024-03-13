<?php

namespace FireFly\FilamentBlog\Enums;

enum PostStatus: string
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
}
