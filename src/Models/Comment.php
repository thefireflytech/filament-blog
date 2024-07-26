<?php

namespace Firefly\FilamentBlog\Models;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Firefly\FilamentBlog\Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
        'approved',
        'approved_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'post_id' => 'integer',
        'approved' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('filamentblog.user.model'), 'user_id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    protected static function newFactory()
    {
        return new CommentFactory();
    }

    public function scopeApproved(Builder $query)
    {
        return $query->where('approved', true);
    }

    public static function getForm(): array
    {
        return [
            Select::make('user_id')
                ->relationship('user', config('filamentblog.user.columns.name'))
                ->required(),
            Select::make('post_id')
                ->relationship('post', 'title')
                ->required(),
            Textarea::make('comment')
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
            Toggle::make('approved'),
        ];
    }

    public function getTable()
    {
        return config('filamentblog.tables.prefix') . 'comments';
    }
}
