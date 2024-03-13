<?php

namespace FireFly\FilamentBlog\Traits;

trait HasAvatar
{
    public function avatar()
    {
        return $this->{config('filamentblog.author.photo_column')} ?? 'https://i.pravatar.cc/300';
    }
}
