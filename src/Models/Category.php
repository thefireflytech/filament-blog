<?php

namespace Firefly\FilamentBlog\Models;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Firefly\FilamentBlog\Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

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
        return $this->belongsToMany(Post::class);
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->live()->afterStateUpdated(fn (Set $set, ?string $state) => $set(
                    'slug',
                    Str::slug($state)
                ))
                ->unique('categories', 'name', null, 'id')
                ->required()
                ->maxLength(155),

            TextInput::make('slug')
                ->unique('categories', 'slug', null, 'id')
                ->readOnly()
                ->maxLength(255),
        ];
    }

    protected static function newFactory()
    {
        return new CategoryFactory();
    }
}
