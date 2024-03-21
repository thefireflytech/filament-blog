<?php

use FireFly\FilamentBlog\Models\Post;
use FireFly\FilamentBlog\Models\User;

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
    //    $this->withoutExceptionHandling();

    // Act & Assert
    post(route('filamentblog.comment.store', $this->post), $this->comment)
        ->assertServerError();
});

it('only allow authenticated user to comment on post', function () {

    actingAs($this->user);

    post(route('filamentblog.comment.store', $this->post), $this->comment)
        ->assertRedirect();

});
