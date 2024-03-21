<?php

use FireFly\FilamentBlog\Models\Category;
use FireFly\FilamentBlog\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has posts', function () {
    // Arrange
    $category = Category::factory()
        ->hasAttached(Post::factory()->count(3))
        ->create();

    // Act & Assert
    expect($category->posts)
        ->toHaveCount(3)
        ->each
        ->toBeInstanceOf(Post::class);
});
