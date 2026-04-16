<?php

namespace Firefly\FilamentBlog\Traits;

use Attribute;
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
        $avatarColumn = config('filamentblog.user.columns.avatar', 'profile_photo_path');
        
        $attributes = $this->getAttributes();
        $avatarValue = $attributes[$avatarColumn] ?? null;
        
        if ($avatarValue) {
            return asset('storage/' . $avatarValue);
        }
        
        $nameColumn = config('filamentblog.user.columns.name', 'name');
        $nameValue = $attributes[$nameColumn] ?? 'User';
        return 'https://ui-avatars.com/api/?&background=random&name=' . urlencode($nameValue);
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
