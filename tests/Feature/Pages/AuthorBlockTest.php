<?php

use Firefly\FilamentBlog\Models\Post;

use function Pest\Laravel\get;

beforeEach(function () {
    setSettingData();
});

it('renders author block when enabled', function () {
    // Arrange
    $post = Post::factory()->published()->create();

    // Act & Assert
    get(route('filamentblog.post.show', $post))
        ->assertSeeText($post->user->name)
        ->assertSeeText(__('filament-blog::blog-views.blogs.show.author_default_description'));
});

it('does not render author block when disabled', function () {
    // Arrange
    config(['filamentblog.features.show_author' => false]);
    $post = Post::factory()->published()->create();

    // Act & Assert
    get(route('filamentblog.post.show', $post))
        ->assertDontSee(__('filament-blog::blog-views.blogs.show.author_default_description'));
});
