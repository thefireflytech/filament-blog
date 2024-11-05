<?php

namespace Firefly\FilamentBlog\Http\Controllers;

use Firefly\FilamentBlog\Facades\SEOMeta;
use Firefly\FilamentBlog\Models\NewsLetter;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\ShareSnippet;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index(Request $request)
    {
        SEOMeta::setTitle('Blog | '.config('app.name')) ;

        $posts = Post::query()->with(['categories', 'user', 'tags'])
            ->published()
            ->paginate(10);

        return view('filament-blog::blogs.index', [
            'posts' => $posts,
        ]);
    }

    public function allPosts()
    {
        SEOMeta::setTitle('All posts | '.config('app.name')) ;

        $posts = Post::query()->with(['categories', 'user'])
            ->published()
            ->paginate(20);

        return view('filament-blog::blogs.all-post', [
            'posts' => $posts,
        ]);
    }

    public function search(Request $request)
    {
        SEOMeta::setTitle('Search result for '.$request->get('query'));

        $request->validate([
            'query' => 'required',
        ]);
        $searchedPosts = Post::query()
            ->with(['categories', 'user'])
            ->published()
            ->whereAny(['title', 'sub_title'], 'like', '%'.$request->get('query').'%')
            ->paginate(10)->withQueryString();

        return view('filament-blog::blogs.search', [
            'posts' => $searchedPosts,
            'searchMessage' => 'Search result for '.$request->get('query'),
        ]);
    }

    public function show(Post $post)
    {
        SEOMeta::setTitle($post->seoDetail?->title);

        SEOMeta::setDescription($post->seoDetail?->description);

        SEOMeta::setKeywords($post->seoDetail->keywords ?? []);

        $shareButton = ShareSnippet::query()->active()->first();
        $post->load(['user', 'categories', 'tags', 'comments' => fn ($query) => $query->approved(), 'comments.user']);

        return view('filament-blog::blogs.show', [
            'post' => $post,
            'shareButton' => $shareButton,
        ]);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique(NewsLetter::class, 'email')
            ],
        ], [
            'email.unique' => 'You have already subscribed',
        ]);

        NewsLetter::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'You have successfully subscribed to our news letter');
    }
}
