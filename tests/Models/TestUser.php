<?php

namespace Firefly\FilamentBlog\Tests\Models;

use Firefly\FilamentBlog\Database\Factories\UserFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Firefly\FilamentBlog\Traits\HasBlog;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestUser extends Authenticatable
{
    use HasBlog, HasFactory;

    protected $table = 'users';    
    protected $fillable = ['name', 'email', 'password', 'profile_photo_path'];

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}