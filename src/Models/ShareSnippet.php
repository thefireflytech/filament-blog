<?php

namespace Firefly\FilamentBlog\Models;

use Firefly\FilamentBlog\Database\Factories\ShareSnippetFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareSnippet extends Model
{
    use HasFactory;

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'share_snippets';
    }

    protected $fillable = [
        'script_code',
        'html_code',
    ];

    protected $casts = [
        'script_code' => 'string',
        'html_code' => 'string',
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }

    protected static function newFactory()
    {
        return new ShareSnippetFactory();
    }
}
