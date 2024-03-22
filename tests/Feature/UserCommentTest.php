<?php

use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\User;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->post = Post::factory()->published()->create();
    $this->user = User::factory()->create();
    $this->comment = [
        'comment' => 'This is a comment',
        'user_id' => $this->user->id,
    ];
});
it('not allow for un authenticated user to comment on post', function () {
    $this->withoutExceptionHandling();

    //Arrange

    $this->expectException(RouteNotFoundException::class);
    $this->expectExceptionMessage('Route [login] not defined.');

    // Act & Assert
    post(route('filamentblog.comment.store', $this->post), $this->comment);
});

it('only allow authenticated user to comment on post', function () {
    $this->withoutExceptionHandling();

    // Act
    actingAs($this->user);

    expect(post(route('filamentblog.comment.store', $this->post), $this->comment))
        ->assertRedirectToRoute('filamentblog.post.show', $this->post);

    // Assert
    $this->assertDatabaseHas('comments', $this->comment);
});
