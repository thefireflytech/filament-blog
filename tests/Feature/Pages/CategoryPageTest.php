<?php

use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Post;
use Illuminate\Database\Eloquent\Factories\Sequence;

use function Pest\Laravel\get;

it('show success response for category post page', function () {
    $category = Category::factory()
        ->hasAttached(Post::factory()->count(3)->state(new Sequence(
            ['title' => 'First Post', 'slug' => 'first-post'],
            ['title' => 'Second Post', 'slug' => 'second-post'],
            ['title' => 'Third Post', 'slug' => 'third-post'],
        )))
        ->create();

    get(route('filamentblog.category.post', $category))
        ->assertSeeText(['First Post', 'Second Post', 'Third Post'])
        ->assertOk();
});
