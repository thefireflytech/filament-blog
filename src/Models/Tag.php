<?php

namespace Firefly\FilamentBlog\Models;

use Firefly\FilamentBlog\Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function posts(): BelongsToMany
    {

        return $this->belongsToMany(Post::class, config('filamentblog.tables.prefix').'post_'.config('filamentblog.tables.prefix').'tag');
    }

    protected static function newFactory()
    {
        return new TagFactory();
    }

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'tags';
    }
}
