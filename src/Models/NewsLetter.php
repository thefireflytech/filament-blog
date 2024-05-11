<?php

namespace Firefly\FilamentBlog\Models;

use Firefly\FilamentBlog\Database\Factories\NewsLetterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'subscribed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean',
    ];

    public function scopeSubscribed()
    {
        return $this->where('subscribed', true);
    }

    protected static function newFactory()
    {
        return new NewsLetterFactory();
    }

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'news_letters';
    }
}
