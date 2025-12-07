<?php

namespace Firefly\FilamentBlog\Http\Controllers;

use App\Models\User;
use Firefly\FilamentBlog\Facades\SEOMeta;
use Firefly\FilamentBlog\Models\NewsLetter;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\ShareSnippet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index(Request $request)
    {
        SEOMeta::setTitle(__('filament-blog::blog-views.blogs.seo.blog') . config('app.name'));

        $posts = Post::query()->with(['categories', 'user', 'tags'])
            ->published()
            ->paginate(10);

        return view('filament-blog::blogs.index', [
            'posts' => $posts,
        ]);
    }

    public function allPosts()
    {
        SEOMeta::setTitle(__('filament-blog::blog-views.blogs.seo.all_posts') . config('app.name'));

        $posts = Post::query()->with(['categories', 'user'])
            ->published()
            ->paginate(20);

        return view('filament-blog::blogs.all-post', [
            'posts' => $posts,
        ]);
    }

    public function search(Request $request)
    {
        SEOMeta::setTitle(__('filament-blog::blog-views.blogs.seo.search_result') . $request->get('query'));

        $request->validate([
            'query' => 'required',
        ]);
        $searchedPosts = Post::query()
            ->with(['categories', 'user'])
            ->published()
            ->whereAny(['title', 'sub_title'], 'like', '%' . $request->get('query') . '%')
            ->paginate(10)->withQueryString();

        return view('filament-blog::blogs.search', [
            'posts' => $searchedPosts,
            'searchMessage' => __('filament-blog::blog-views.messages.search_result_for', ['query' => $request->get('query')]),
        ]);
    }

    public function show(Post $post)
    {
        SEOMeta::setTitle($post->seoDetail?->title);

        SEOMeta::setDescription($post->seoDetail?->description);

        SEOMeta::setKeywords($post->seoDetail->keywords ?? []);

        $shareButton = ShareSnippet::query()->active()->first();
        $post->load(['user', 'categories', 'tags', 'comments' => fn($query) => $query->approved(), 'comments.user']);

        $user = Auth::user();
        $canComment = $user && method_exists($user, 'canComment') ? $user->canComment() : false;

        return view('filament-blog::blogs.show', [
            'post' => $post,
            'shareButton' => $shareButton,
            'canComment' => $canComment,
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
            'email.unique' => __('filament-blog::blog-views.messages.already_subscribed'),
        ]);

        NewsLetter::create([
            'email' => $request->email,
        ]);

        return back()->with('success', __('filament-blog::blog-views.messages.subscribed_successfully'));
    }
}
