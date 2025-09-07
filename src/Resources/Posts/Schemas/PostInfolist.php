<?php

namespace Firefly\FilamentBlog\Resources\Posts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Firefly\FilamentBlog\Enums\PostStatus;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\Tag;

class PostInfolist
{
    public static function configure(Schema $schema, ?Category $category = null, ?Tag $tag = null): Schema
    {
        return $schema->components([
            Section::make('Post')
                ->columnSpanFull()
                ->schema([
                    Fieldset::make('General')
                        ->schema([
                            TextEntry::make('title'),
                            TextEntry::make('slug'),
                            TextEntry::make('sub_title'),
                        ]),
                    Fieldset::make('Categories')
                        ->hidden(fn() => $category?->exists())
                        ->schema([
                            TextEntry::make('name')
                                ->getStateUsing(function (Post $record) {
                                    return $record->categories->pluck('name');
                                })
                                ->hiddenLabel()
                                ->badge(),
                        ]),
                    Fieldset::make('Tags')
                        ->hidden(fn() => $tag?->exists())
                        ->schema([
                            TextEntry::make('name')
                                ->getStateUsing(function (Post $record) {
                                    return $record->tags->pluck('name');
                                })
                                ->hiddenLabel()
                                ->badge(),
                        ]),
                    Fieldset::make('Publish Information')
                        ->schema([
                            TextEntry::make('status')
                                ->badge()->color(function ($state) {
                                    return $state->getColor();
                                }),
                            TextEntry::make('published_at')->visible(function (Post $record) {
                                return $record->status === PostStatus::PUBLISHED;
                            }),

                            TextEntry::make('scheduled_for')->visible(function (Post $record) {
                                return $record->status === PostStatus::SCHEDULED;
                            }),
                        ]),
                    Fieldset::make('Description')
                        ->schema([
                            TextEntry::make('body')
                                ->html()
                                ->columnSpanFull(),
                        ]),
                ]),
        ]);
    }
}
