<?php

namespace Firefly\FilamentBlog\Components;

use Firefly\FilamentBlog\Models\Post;
use Illuminate\View\Component;

class RecentPost extends Component
{
    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $posts = Post::query()->published()->whereNot('slug', request('post')->slug)->latest()->take(5)->get();

        return view('filament-blog::components.recent-post', [
            'posts' => $posts,
        ]);
    }
}
