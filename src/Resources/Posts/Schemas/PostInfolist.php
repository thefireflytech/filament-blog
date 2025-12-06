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
            Section::make(__('filament-blog.post.post'))
                ->columnSpanFull()
                ->schema([
                    Fieldset::make(__('filament-blog.common.general'))
                        ->schema([
                            TextEntry::make('title')
                                ->label(__('filament-blog.common.title')),
                            TextEntry::make('slug')
                                ->label(__('filament-blog.common.slug')),
                            TextEntry::make('sub_title')
                                ->label(__('filament-blog.post.sub_title')),
                        ]),
                    Fieldset::make(__('filament-blog.category.categories'))
                        ->hidden(fn() => $category?->exists())
                        ->schema([
                            TextEntry::make('name')
                                ->label(__('filament-blog.common.name'))
                                ->getStateUsing(function (Post $record) {
                                    return $record->categories->pluck('name');
                                })
                                ->hiddenLabel()
                                ->badge(),
                        ]),
                    Fieldset::make(__('filament-blog.tag.tags'))
                        ->hidden(fn() => $tag?->exists())
                        ->schema([
                            TextEntry::make('name')
                                ->label(__('filament-blog.common.name'))
                                ->getStateUsing(function (Post $record) {
                                    return $record->tags->pluck('name');
                                })
                                ->hiddenLabel()
                                ->badge(),
                        ]),
                    Fieldset::make(__('filament-blog.post.publish_information'))
                        ->schema([
                            TextEntry::make('status')
                                ->label(__('filament-blog.post.status'))
                                ->badge()->color(function ($state) {
                                    return $state->getColor();
                                }),
                            TextEntry::make('published_at')
                                ->label(__('filament-blog.post.published_at'))
                                ->visible(function (Post $record) {
                                    return $record->status === PostStatus::PUBLISHED;
                                }),

                            TextEntry::make('scheduled_for')
                                ->label(__('filament-blog.post.scheduled_for'))
                                ->visible(function (Post $record) {
                                    return $record->status === PostStatus::SCHEDULED;
                                }),
                        ]),
                    Fieldset::make(__('filament-blog.common.description'))
                        ->schema([
                            TextEntry::make('body')
                                ->label(__('filament-blog.post.body'))
                                ->html()
                                ->columnSpanFull(),
                        ]),
                ]),
        ]);
    }
}
