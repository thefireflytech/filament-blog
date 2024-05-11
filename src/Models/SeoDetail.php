<?php

namespace Firefly\FilamentBlog\Models;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Firefly\FilamentBlog\Database\Factories\SeoDetailFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeoDetail extends Model
{
    use HasFactory;

    const KEYWORDS = [
        'technology',
        'innovation',
        'science',
        'artificial intelligence',
        'machine learning',
        'data science',
        'coding',
        'programming',
        'web development',
        'cybersecurity',
        'digital marketing',
        'social media',
        'business',
        'finance',
        'health',
        'fitness',
        'travel',
        'food',
        'photography',
        'music',
        'movies',
        'fashion',
        'sports',
        'gaming',
        'books',
        'education',
        'history',
        'culture',
    ];

    protected $fillable = [
        'post_id',
        'title',
        'keywords',
        'description',
        'user_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'user_id' => 'integer',
        'keywords' => 'json',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class)->orderByDesc('id');
    }

    public static function getForm()
    {
        return [
            Select::make('post_id')
                ->createOptionForm(Post::getForm())
                ->editOptionForm(Post::getForm())
                ->relationship('post', 'title')
                ->unique(config('filamentblog.tables.prefix').'seo_details', 'post_id', null, 'id')
                ->required()
                ->preload()
                ->searchable()
                ->default(request('post_id') ?? '')
                ->columnSpanFull(),
            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            TagsInput::make('keywords')
                ->columnSpanFull(),
            Textarea::make('description')
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
        ];
    }

    protected static function newFactory()
    {
        return new SeoDetailFactory();
    }

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'seo_details';
    }
}
