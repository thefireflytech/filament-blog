<?php

namespace Firefly\FilamentBlog\Traits;

use Firefly\FilamentBlog\Models\Comment;
use Firefly\FilamentBlog\Models\Post;

trait HasBlog
{
    public function name()
    {
        return $this->{config('filamentblog.user.columns.name')};
    }

    public function getAvatarAttribute()
    {
        return $this->{config('filamentblog.user.columns.avatar')}
            ? asset('storage/'.$this->{config('filamentblog.user.columns.avatar')}) : 'https://ui-avatars.com/api/?&background=random&name='.$this->{config('filamentblog.user.columns.name')};
    }

    public function posts()
    {
        return $this->hasMany(Post::class, config('filamentblog.user.foreign_key'));
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, config('filamentblog.user.foreign_key'));
    }
}
