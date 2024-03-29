<?php

use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Post;

use function Pest\Laravel\get;
beforeEach(function () {
    setSettingData();
});
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
    $this->withoutExceptionHandling();

    // Arrange
    $post = Post::factory()
        ->published()
        ->hasAttached(Category::factory()->count(1))
        ->hasSeoDetail([
            'description' => 'This is a description for the post',
        ])
        ->hasComments([
            'approved' => true,
        ])
        ->create(); // Act & Assert

    get(route('filamentblog.post.show', $post))
        ->assertSeeText([
            $post->title,
            $post->sub_title,
            $post->formattedPublishedDate(),
            $post->user->name,
            $post->categories->first()->name,
            $post->comments->first()->comment,
            'Related Posts',
            'Leave a reply',
        ])->assertSee([
            $post->seoDetail->description,
        ]);
});
