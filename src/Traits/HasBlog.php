<?php

namespace FireFly\FilamentBlog\Traits;

use FireFly\FilamentBlog\Models\Post;

trait HasBlog
{
    public function name()
    {
        return $this->{config('filamentblog.user.columns.name')};
    }

    public function getAvatarAttribute()
    {
        return $this->{config('filamentblog.user.columns.avatar')}
            ?? 'https://ui-avatars.com/api/?&background=random&name='.$this->{config('filamentblog.user.columns.name')};
    }

    public function blogs()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {

    }
}
