<?php

namespace Firefly\FilamentBlog\Http\Controllers;

use App\Models\User;
use DOMDocument;
use Firefly\FilamentBlog\Facades\SEOMeta;
use Firefly\FilamentBlog\Models\NewsLetter;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\ShareSnippet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

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

    private function generateTableOfContents(Post $post, bool $tocEnabled, bool $includeTitle): array
    {
        $toc = [];
        if (!$tocEnabled) {
            return $toc;
        }
        $html = new DOMDocument();
        @$html->loadHTML(mb_convert_encoding($post->body, 'HTML-ENTITIES', 'UTF-8'));

        if ($includeTitle) {
            $toc[] = [
                'tag'   => 'h1',
                'text'  => $post->title,
                'id'    => Str::slug($post->title) . '-post-title',
                'depth' => 0,
            ];
        }

        $headingTags = ['h1', 'h2'];
        foreach ($headingTags as $tag) {
            $headings = $html->getElementsByTagName($tag);
            foreach ($headings as $heading) {
                $text = trim($heading->textContent);
                if ($text === '') {
                    continue;
                }
                $id = Str::slug($text);
                $uniqueId = $id;
                $counter = 1;
                while (collect($toc)->pluck('id')->contains($uniqueId)) {
                    $uniqueId = $id . '-' . $counter++;
                }
                $toc[] = [
                    'tag'   => $tag,
                    'text'  => $text,
                    'id'    => $uniqueId,
                    'depth' => ($tag === 'h1') ? 0 : 1,
                ];
                $heading->setAttribute('id', $uniqueId);
            }
        }

        $post->body = $html->saveHTML();
        return $toc;
    }

    public function show(Post $post)
    {
        SEOMeta::setTitle($post->seoDetail?->title);

        SEOMeta::setDescription($post->seoDetail?->description);

        SEOMeta::setKeywords($post->seoDetail->keywords ?? []);
        
        // Open Graph
        SEOMeta::setOgTitle($post->seoDetail?->og_title ?? $post->seoDetail?->title ?? $post->title);
        SEOMeta::setOgDescription($post->seoDetail?->og_description ?? $post->seoDetail?->description ?? $post->sub_title);
        if ($post->seoDetail?->og_image) {
            SEOMeta::setOgImage(asset('storage/' . $post->seoDetail->og_image));
        } else {
            SEOMeta::setOgImage($post->feature_photo);
        }

        // Twitter Card
        SEOMeta::setTwitterTitle($post->seoDetail?->twitter_title ?? $post->seoDetail?->title ?? $post->title);
        SEOMeta::setTwitterDescription($post->seoDetail?->twitter_description ?? $post->seoDetail?->description ?? $post->sub_title);
        if ($post->seoDetail?->twitter_image) {
            SEOMeta::setTwitterImage(asset('storage/' . $post->seoDetail->twitter_image));
        } else {
            SEOMeta::setTwitterImage($post->feature_photo);
        }

        $tocEnabled = config('filamentblog.post_rendering.table_of_content.enabled', false);
        $includeTitle = data_get(config('filamentblog.post_rendering.table_of_content', []), 'title', true);
        $toc = $this->generateTableOfContents($post, $tocEnabled, $includeTitle);

        $shareButton = ShareSnippet::query()->active()->first();
        $post->load(['user', 'categories', 'tags', 'comments' => fn($query) => $query->approved(), 'comments.user']);

        $user = Auth::user();
        $canComment = $user && method_exists($user, 'canComment') ? $user->canComment() : false;

        return view('filament-blog::blogs.show', [
            'post' => $post,
            'shareButton' => $shareButton,
            'canComment' => $canComment,
            'toc' => $toc,             
            'tocEnabled' => $tocEnabled, 
            'includeTitle' => $includeTitle,
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
