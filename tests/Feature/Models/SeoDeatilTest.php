<?php

use FireFly\FilamentBlog\Models\Post;
use FireFly\FilamentBlog\Models\SeoDetail;

it('belongs to post', function () {
    // Arrange
    $post = Post::factory()->has(SeoDetail::factory())->create();

    // Act & Assert
    expect($post->seoDetail)->toBeInstanceOf(SeoDetail::class);
});
