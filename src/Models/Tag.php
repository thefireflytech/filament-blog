<?php

namespace FireFly\FilamentBlog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->live()->afterStateUpdated(fn(Set $set, ?string $state) => $set(
                    'slug',
                    Str::slug($state)
                ))
                ->unique('tags', 'name', null, 'id')
                ->required()
                ->maxLength(155),

            TextInput::make('slug')
                ->unique('tags', 'slug', null, 'id')
                ->readOnly()
                ->maxLength(255),
        ];
    }
}
