<?php

namespace Firefly\FilamentBlog\Models;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Firefly\FilamentBlog\Database\Factories\SettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'logo'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected function getLogoImageAttribute()
    {
        return asset('storage/'.$this->logo);
    }

    protected static function newFactory()
    {
        return SettingFactory::new();
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('title')
                ->maxLength(155)
                ->required(),
            Textarea::make('description')
                ->required()
                ->minLength(10)
                ->maxLength(1000)
                ->columnSpanFull(),
            FileUpload::make('logo')
                ->directory('setting/logo')
                ->maxSize(1024 * 1024 * 2)
                ->avatar()
                ->nullable(),
        ];
    }
}
