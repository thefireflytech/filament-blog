<?php

namespace Firefly\FilamentBlog\Models;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Firefly\FilamentBlog\Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

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

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->live(true)->afterStateUpdated(fn(Set $set, ?string $state) => $set(
                    'slug',
                    Str::slug($state)
                ))
                ->unique(config('filamentblog.tables.prefix').'tags', 'name', null, 'id')
                ->required()
                ->maxLength(50),

            TextInput::make('slug')
                ->unique(config('filamentblog.tables.prefix').'tags', 'slug', null, 'id')
                ->readOnly()
                ->maxLength(155),
        ];
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
