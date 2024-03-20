<?php

namespace FireFly\FilamentBlog\Models;

use FireFly\FilamentBlog\Database\Factories\PostTagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'tag_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'tag_id' => 'integer',
    ];

    protected static function newFactory()
    {
        return new PostTagFactory();
    }
}
