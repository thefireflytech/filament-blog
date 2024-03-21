<?php

use FireFly\FilamentBlog\Models\Post;
use FireFly\FilamentBlog\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Sequence;

use function Pest\Laravel\get;

it('show success response for tag post page', function () {
    $category = Tag::factory()
        ->hasAttached(Post::factory()->count(3)->state(new Sequence(
            ['title' => 'First Post', 'slug' => 'first-post'],
            ['title' => 'Second Post', 'slug' => 'second-post'],
            ['title' => 'Third Post', 'slug' => 'third-post'],
        )))
        ->create();

    get(route('filamentblog.tag.post', $category))
        ->assertSeeText(['First Post', 'Second Post', 'Third Post'])
        ->assertOk();
});
