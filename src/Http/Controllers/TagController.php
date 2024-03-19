<?php

namespace FireFly\FilamentBlog\Http\Controllers;

use FireFly\FilamentBlog\Models\Tag;

class TagController extends Controller
{
    public function posts(Tag $tag)
    {
        $posts = $tag->load(['posts.user'])->posts()->paginate(25);

        return view('filament-blog::blogs.tag-post', [
            'posts' => $posts,
            'tag' => $tag,
        ]);
    }
}
