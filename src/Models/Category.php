<?php

namespace Firefly\FilamentBlog\Models;

use Firefly\FilamentBlog\Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
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
        return $this->belongsToMany(Post::class, config('filamentblog.tables.prefix').'category_'.config('filamentblog.tables.prefix').'post');
    }

    protected static function newFactory()
    {
        return new CategoryFactory();
    }

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'categories';
    }
}
