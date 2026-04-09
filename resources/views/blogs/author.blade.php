<div class="border-t-2 pt-6 pb-4 mt-4">
    <div class="flex items-center gap-x-4">
        <img class="h-12 w-12 rounded-full object-cover ring-1 ring-slate-200" src="{{ $post->user->avatar }}" alt="{{ $post->user->name() }}">
        <div>
            <h3 class="text-base font-semibold">{{ $post->user->name() }}</h3>
            @php
                $bio = null;
                if (method_exists($post->user, 'bio') && $post->user->bio()) {
                    $bio = $post->user->bio();
                } elseif (isset($post->user->bio) && $post->user->bio) {
                    $bio = $post->user->bio;
                }
            @endphp
            <p class="text-sm text-slate-600">
                {{ $bio ?? __('filament-blog::blog-views.blogs.show.author_default_description', ['app' => config('app.name')]) }}
            </p>
        </div>
        <div class="ml-auto">
            @if (Route::has('filamentblog.author.posts'))
                <a href="{{ route('filamentblog.author.posts', ['author' => $post->user->{config('filamentblog.user.columns.name')}]) }}" class="rounded-full border px-3 py-2 text-sm font-medium hover:bg-slate-100">{{ __('filament-blog::blog-views.blogs.show.more_from_author', ['author' => $post->user->name()]) }}</a>
            @endif
        </div>
    </div>
</div>
