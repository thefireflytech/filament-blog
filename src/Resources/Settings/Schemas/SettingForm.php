<?php

namespace Firefly\FilamentBlog\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(__('filament-blog.setting.general_information'))
                ->schema([
                    TextInput::make('title')
                        ->label(__('filament-blog.common.title'))
                        ->maxLength(155)
                        ->required(),
                    TextInput::make('organization_name')
                        ->label(__('filament-blog.setting.organization_name'))
                        ->required()
                        ->maxLength(155)
                        ->minLength(3),
                    Textarea::make('description')
                        ->label(__('filament-blog.common.description'))
                        ->required()
                        ->minLength(10)
                        ->maxLength(1000)
                        ->columnSpanFull(),
                    FileUpload::make('logo')
                        ->label(__('filament-blog.setting.logo'))
                        ->hint(__('filament-blog.setting.logo_height_hint'))
                        ->directory('setting/logo')
                        ->maxSize(1024 * 1024 * 2)
                        ->rules('dimensions:max_height=400')
                        ->nullable()->columnSpanFull(),
                    FileUpload::make('favicon')
                        ->label(__('filament-blog.setting.favicon'))
                        ->directory('setting/favicon')
                        ->maxSize(50)
                        ->nullable()->columnSpanFull()
                ])->columns(2),

            Section::make(__('filament-blog.seo.seo'))
                ->description(__('filament-blog.setting.analytics_adsense_hint'))
                ->schema([
                    Textarea::make('google_console_code')
                        ->label(__('filament-blog.setting.google_console_code'))
                        ->startsWith('<meta')
                        ->nullable()
                        ->columnSpanFull(),
                    Textarea::make('google_analytic_code')
                        ->label(__('filament-blog.setting.google_analytic_code'))
                        ->startsWith('<script')
                        ->endsWith('</script>')
                        ->nullable()
                        ->columnSpanFull(),
                    Textarea::make('google_adsense_code')
                        ->label(__('filament-blog.setting.google_adsense_code'))
                        ->startsWith('<script')
                        ->endsWith('</script>')
                        ->nullable()
                        ->columnSpanFull(),
                ])->columns(2),
            Section::make(__('filament-blog.setting.quick_links'))
                ->description(__('filament-blog.setting.quick_links_hint'))
                ->schema([
                    Repeater::make('quick_links')
                        ->label(__('filament-blog.setting.links'))
                        ->schema([
                            TextInput::make('label')
                                ->label(__('filament-blog.setting.label'))
                                ->required()
                                ->maxLength(155),
                            TextInput::make('url')
                                ->label(__('filament-blog.setting.url'))
                                ->helperText(__('filament-blog.setting.url_protocol_required'))
                                ->required()
                                ->url()
                                ->maxLength(255),
                        ])->columns(2),
                ])->columnSpanFull(),
        ]);
    }
}
