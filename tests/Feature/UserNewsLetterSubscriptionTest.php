<?php

use function Pest\Laravel\post;

it('allow user to subscribe news letter with email', function () {
    $data = [
        'email' => 'johndeo@example.com',
    ];
    post(route('filamentblog.post.subscribe'), $data)
        ->assertRedirect()->assertSessionHas('success', 'You have successfully subscribed to our news letter');
});
