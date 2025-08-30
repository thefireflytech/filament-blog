<?php

namespace Firefly\FilamentBlog\Resources\Settings;

use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Resources\Settings\Pages\ListSettings;
use Firefly\FilamentBlog\Resources\Settings\Pages\CreateSetting;
use Firefly\FilamentBlog\Resources\Settings\Pages\EditSetting;
use Firefly\FilamentBlog\Resources\Settings\Schemas\SettingForm;
use Firefly\FilamentBlog\Resources\Settings\Tables\SettingsTable;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Setting;
use BackedEnum;
use UnitEnum;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string | UnitEnum | null $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 8;

    public static function form(Schema $schema): Schema
    {
        return SettingForm::configure($schema);
    }

    public static function canCreate(): bool
    {
        return Setting::count() === 0;
    }

    public static function table(Table $table): Table
    {
        return SettingsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}
