<?php

namespace FireFly\FilamentBlog\Traits;

trait HasAvatar
{
    public function avatar()
    {
        return $this->{config('filamentblog.user.photo_column')} ?? 'https://i.pravatar.cc/300';
    }
}
