<?php

use FireFly\FilamentBlog\Models\Category;
use FireFly\FilamentBlog\Models\Post;

use function Pest\Laravel\get;

it('show published post cards', function () {
    // Arrange
    $firstPost = Post::factory()
        ->hasAttached(Category::factory()->count(1))
        ->published()
        ->create();

    $secondPost = Post::factory()->published()->create();
    $thirdPost = Post::factory()->create();
    // Act & Assert
    get(route('filamentblog.post.index'))
        ->assertSeeText([
            $firstPost->title,
            $firstPost->sub_title,
            $firstPost->formattedPublishedDate(),
            $firstPost->user->name,

            $secondPost->title,
            $secondPost->sub_title,
            $secondPost->formattedPublishedDate(),
            $secondPost->user->name,

        ])
        ->assertDontSeeText([
            $thirdPost->title,
            $thirdPost->sub_title,
            $thirdPost->formattedPublishedDate(),
            $thirdPost->user->name,
        ]);
});
