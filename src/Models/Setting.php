<?php

namespace Firefly\FilamentBlog\Models;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;
use Firefly\FilamentBlog\Database\Factories\SettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Descriptor\TextDescriptor;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'logo',
        'organization_name',
        'google_analytic_code',
        'google_adsense_code',
        'quick_links',
    ];

    protected $casts = [
        'quick_links' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected function getLogoImageAttribute()
    {
        return asset('storage/' . $this->logo);
    }

    protected static function newFactory()
    {
        return new SettingFactory();
    }

    public static function getForm(): array
    {
        return [
            Section::make('General Information')
                ->schema([
                    TextInput::make('title')
                        ->maxLength(155)
                        ->required(),
                    TextInput::make('organization_name')
                        ->required()
                        ->maxLength(155)
                        ->minLength(3),
                    Textarea::make('description')
                        ->required()
                        ->minLength(10)
                        ->maxLength(1000)
                        ->columnSpanFull(),
                    FileUpload::make('logo')
                        ->directory('setting/logo')
                        ->maxSize(1024 * 1024 * 2)
                        ->nullable()->columnSpanFull()
                ])->columns(2),

            Section::make('SEO')
                ->description('Place your google analytic and adsense code here. This will be added to the head tag of your blog post only.')
                ->schema([
                    Textarea::make('google_analytic_code')
                        ->startsWith('<script>')
                        ->endsWith('</script>')
                        ->nullable()
                        ->columnSpanFull(),
                    Textarea::make('google_adsense_code')
                        ->startsWith('<script>')
                        ->endsWith('</script>')
                        ->nullable()
                        ->columnSpanFull(),
                ])->columns(2),
            Section::make('Quick Links')
                ->description('Add your quick links here. This will be displayed in the footer of your blog.')
                ->schema([
                    KeyValue::make('quick_links')
                        ->label('Please add full url with http or https.')
                        ->keyLabel('Title')
                        ->valueLabel('URL')
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }
}
