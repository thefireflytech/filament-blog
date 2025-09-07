<?php

namespace Firefly\FilamentBlog\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
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
                        ->hint('Max height 400')
                        ->directory('setting/logo')
                        ->maxSize(1024 * 1024 * 2)
                        ->rules('dimensions:max_height=400')
                        ->nullable()->columnSpanFull(),
                    FileUpload::make('favicon')
                        ->directory('setting/favicon')
                        ->maxSize(50)
                        ->nullable()->columnSpanFull()
                ])->columns(2),

            Section::make('SEO')
                ->description('Place your google analytic and adsense code here. This will be added to the head tag of your blog post only.')
                ->schema([
                    Textarea::make('google_console_code')
                        ->startsWith('<meta')
                        ->nullable()
                        ->columnSpanFull(),
                    Textarea::make('google_analytic_code')
                        ->startsWith('<script')
                        ->endsWith('</script>')
                        ->nullable()
                        ->columnSpanFull(),
                    Textarea::make('google_adsense_code')
                        ->startsWith('<script')
                        ->endsWith('</script>')
                        ->nullable()
                        ->columnSpanFull(),
                ])->columns(2),
            Section::make('Quick Links')
                ->description('Add your quick links here. This will be displayed in the footer of your blog.')
                ->schema([
                    Repeater::make('quick_links')
                        ->label('Links')
                        ->schema([
                            TextInput::make('label')
                                ->required()
                                ->maxLength(155),
                            TextInput::make('url')
                                ->label('URL')
                                ->helperText('URL should start with http:// or https://')
                                ->required()
                                ->url()
                                ->maxLength(255),
                        ])->columns(2),
                ])->columnSpanFull(),
        ]);
    }
}
