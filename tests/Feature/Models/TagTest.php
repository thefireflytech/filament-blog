<?php

use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\Tag;

it('has posts', function () {
    // Arrange
    $tag = Tag::factory()
        ->hasAttached(Post::factory()->count(3))
        ->create();

    // Act & Assert
    expect($tag->posts)
        ->toHaveCount(3)
        ->each
        ->toBeInstanceOf(Post::class);
});
