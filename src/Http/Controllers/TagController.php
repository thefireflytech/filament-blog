<?php

namespace FireFly\FilamentBlog\Http\Controllers;

use FireFly\FilamentBlog\Models\Category;

class TagController extends Controller
{
    public function posts(Category $category)
    {
        $posts = $category->load(['posts.user'])->posts()->paginate(25);

        return view('filament-blog::blogs.search', [
            'posts' => $posts,
        ]);
    }
}
