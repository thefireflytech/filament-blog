<x-blog-layout>
    <section>
        <header class="container mx-auto mb-4 max-w-[800px] px-6 pb-4 mt-10 text-center">
            <p class="inherits-color text-balance leading-tighter relative z-10 text-3xl font-semibold tracking-tight">
                @lang('filament-blog::pages/tag-post.title'): {{ $tag->name }}
            </p>
        </header>
    </section>
    <section class="pb-16 pt-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-3 gap-x-14 gap-y-14">
                @forelse ($posts as $post)
                    <x-blog-card :post="$post"/>
                @empty
                    <div class="flex justify-center w-full">
                        <h2 class="text-2xl font-semibold">@lang('filament-blog::pages/tag-post.no-post-found')</h2>
                    </div>
                @endforelse
            </div>
            <div class="mt-20">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

</x-blog-layout>