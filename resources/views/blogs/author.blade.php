<div class="border-t-2 pt-6 pb-4 mt-4">
    <div class="flex items-center gap-x-4">
        <img class="h-12 w-12 rounded-full object-cover ring-1 ring-slate-200" src="{{ $post->user->avatar }}" alt="{{ $post->user->name() }}">
        <div>
            <h3 class="text-base font-semibold">{{ $post->user->name() }}</h3>
            @php
                $bio = $post->user->bio();
                $designation = $post->user->designation();
            @endphp
            <p class="text-sm text-slate-600">
                <span class="font-medium">{{ $designation }}</span>
                {{ $bio ?? __('filament-blog::blog-views.blogs.show.author_default_description', ['app' => config('app.name')]) }}
            </p>
        </div>
    </div>
</div>
