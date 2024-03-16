<?php

namespace FireFly\FilamentBlog\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use FireFly\FilamentBlog\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function posts(Request $request, Category $category)
    {
        $posts = $category->load(['posts.author', 'posts.categories'])->posts()->paginate(25);

        return view('filament-blog::blogs.search', [
            'posts' => $posts,
        ]);
    }
}
