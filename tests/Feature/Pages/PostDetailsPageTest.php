<?php

use FireFly\FilamentBlog\Models\Post;

use function Pest\Laravel\get;

it('does not found pending post', function () {
    // Arrange
    $post = Post::factory()->pending()->create();

    // Act & Assert
    get(route('filamentblog.post.show', $post))
        ->assertNotFound();
});

it('does not found scheduled post', function () {
    // Arrange
    $post = Post::factory()->scheduled()->create();

    // Act & Assert
    get(route('filamentblog.post.show', $post))
        ->assertNotFound();
});

it('show published post details', function () {
    //    $this->withoutExceptionHandling();
    // Arrange
    $post = Post::factory()->published()
        ->hasSeoDetail()
        ->create();
    // Act & Assert
    get(route('filamentblog.post.show', $post))
        ->assertSeeText([
            $post->title,
        ]);
});
