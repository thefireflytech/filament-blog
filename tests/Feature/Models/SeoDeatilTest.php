<?php

use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\SeoDetail;

it('belongs to post', function () {
    // Arrange
    $post = Post::factory()->has(SeoDetail::factory())->create();

    // Act & Assert
    expect($post->seoDetail)->toBeInstanceOf(SeoDetail::class);
});
