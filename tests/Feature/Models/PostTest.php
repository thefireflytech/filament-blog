<?php

use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\SeoDetail;
use Firefly\FilamentBlog\Models\Tag;

it('only returns published post', function () {
    // Arrange
    Post::factory()->published()->create();
    Post::factory()->create();

    // Act & Assert

    expect(Post::published()->count())->toBe(1);

});

it('has categories', function () {
    // Arrange
    $post = Post::factory()
        ->hasAttached(Category::factory()->count(3))
        ->create();

    // Act & Assert
    expect($post->categories)
        ->toHaveCount(3)
        ->each
        ->toBeInstanceOf(Category::class);
});

it('has tags', function () {
    // Arrange
    $post = Post::factory()
        ->hasAttached(Tag::factory()->count(3))
        ->create();

    // Act & Assert
    expect($post->tags)
        ->toHaveCount(3)
        ->each
        ->toBeInstanceOf(Tag::class);
});

it('has seoDetail', function () {
    // Arrange
    $post = Post::factory()->has(SeoDetail::factory(1))
        ->create();

    // Act & Assert
    expect($post->seoDetail)
        ->toBeInstanceOf(SeoDetail::class);

});
