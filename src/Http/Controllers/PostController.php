<?php

namespace FireFly\FilamentBlog\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use FireFly\FilamentBlog\Models\NewsLetter;
use FireFly\FilamentBlog\Models\Post;
use FireFly\FilamentBlog\Models\ShareSnippet;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()->with(['categories', 'author', 'tags'])
            ->published()
            ->paginate(10);

        return view('filament-blog::blogs.index', [
            'posts' => $posts,
        ]);
    }
    public function allPosts()
    {
        $posts = Post::query()->with(['categories', 'author'])
            ->published()
            ->paginate(20);

        return view('filament-blog::blogs.allpost', [
            'posts' => $posts,
        ]);
    }

    public function search(Request $request)
    {
        $searchedPosts = Post::query()
            ->with(['categories', 'author'])
            ->published()
            ->where('title', 'like', '%' . $request->get('query') . '%')
            ->orWhere('sub_title', 'like', '%' . $request->get('query') . '%')
            ->paginate(10)->withQueryString();

        dd($searchedPosts);
        return view('filament-blog::blogs.search', [
            'posts' => $searchedPosts,
        ]);
    }

    public function show(Post $post)
    {
        SEOMeta::setTitle($post->seoDetail->title);

        SEOMeta::setDescription($post->seoDetail->description);

        SEOMeta::addKeyword($post->seoDetail->keywords);

        $shareButton = ShareSnippet::query()->active()->first();
        $post->load(['author', 'categories']);

        return view('filament-blog::blogs.show', [
            'post' => $post,
            'shareButton' => $shareButton,
        ]);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:news_letters,email',
        ], [
            'email.unique' => 'You have already subscribed',
        ]);
        NewsLetter::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'You have been subscribed successfully');
    }
}
