<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\NewsLetter;

class NewsletterResource extends Resource
{
    protected static ?string $model = NewsLetter::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->label(__('filament-blog::news_letters.forms.fields.email'))
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100),
                Forms\Components\Toggle::make('subscribed')
                    ->label(__('filament-blog::news_letters.forms.fields.subscribed'))
                    ->default(true)
                    ->required()->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->label(__('filament-blog::news_letters.tables.columns.email'))
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('subscribed')
                    ->label(__('filament-blog::news_letters.tables.columns.subscribed')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-blog::general.created_at'))
                    ->dateTime(config('filamentblog.date_format') . ' ' . config('filamentblog.time_format'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament-blog::general.updated_at'))
                    ->dateTime(config('filamentblog.date_format') . ' ' . config('filamentblog.time_format'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Firefly\FilamentBlog\Resources\NewsletterResource\Pages\ListNewsletters::route('/'),
            'create' => \Firefly\FilamentBlog\Resources\NewsletterResource\Pages\CreateNewsletter::route('/create'),
            'edit' => \Firefly\FilamentBlog\Resources\NewsletterResource\Pages\EditNewsletter::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string {
        return __('filament-blog::news_letters.title');
    }

    public static function getPluralLabel(): string {
        return __('filament-blog::news_letters.plural_title');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('filamentblog.group_navigation_title');
    }
}
