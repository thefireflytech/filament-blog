<?php

namespace Firefly\FilamentBlog\Models;

use Firefly\FilamentBlog\Database\Factories\PostTagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;

    protected $table = 'fblog_post_tag';

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

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'post_' . config('filamentblog.tables.prefix') . 'tag';
    }
}
