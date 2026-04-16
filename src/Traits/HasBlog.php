<?php

namespace Firefly\FilamentBlog\Traits;

use Firefly\FilamentBlog\Models\Comment;
use Firefly\FilamentBlog\Models\Post;

trait HasBlog
{
    public function name()
    {
        $nameColumn = config('filamentblog.user.columns.name', 'name');
        return $this->getAttributes()[$nameColumn] ?? 'User';
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

    public function designation()
    {
        $column = config('filamentblog.user.columns.designation', 'designation');
        return $this->getAttributes()[$column] ?? null;
    }

    public function bio()
    {
        $column = config('filamentblog.user.columns.bio', 'bio');
        return $this->getAttributes()[$column] ?? null;
    }

    public function moreFromAuthor()
    {
        $column = config('filamentblog.user.columns.more_from_author', 'more_from_author');
        return $this->getAttributes()[$column] ?? null;
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
