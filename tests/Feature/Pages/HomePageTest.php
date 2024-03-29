<?php

use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Post;

use function Pest\Laravel\get;

beforeEach(function () {
    setSettingData();
});
it('show published post cards', function () {
    \Pest\Laravel\withoutExceptionHandling();
    // Arrange
    $firstPost = Post::factory()
        ->hasAttached(Category::factory()->count(1))
        ->published()
        ->create();

    $secondPost = Post::factory()->published()->create();
    $thirdPost = Post::factory()->pending()->create([
        'title' => 'Pending Post',
        'sub_title' => 'This is a pending post',
    ]);

    // Act & Assert
    get(route('filamentblog.post.index'))
        ->assertSeeText([
            $firstPost->title,
            $firstPost->sub_title,
            $firstPost->formattedPublishedDate(),
            $firstPost->user->name,
            $firstPost->categories->first()->name,

            $secondPost->title,
            $secondPost->sub_title,
            $secondPost->formattedPublishedDate(),
            $secondPost->user->name,
        ])
        ->assertDontSeeText([
            $thirdPost->title,
            $thirdPost->sub_title,
        ]);
});
