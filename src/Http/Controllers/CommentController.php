<?php

namespace FireFly\FilamentBlog\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use FireFly\FilamentBlog\Models\Category;
use FireFly\FilamentBlog\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|min:3|max:500',
        ]);

        $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => $request->user()->id,
            'approved' => false
        ]);

        return back()->with('success', 'Comment added successfully');
    }
}
