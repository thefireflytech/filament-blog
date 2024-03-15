<x-blog-layout>
    <section class="py-10">
        <header class="container mx-auto px-6">
            <h3 class="inherits-color text-balance leading-tighter relative z-10 text-3xl font-semibold tracking-tight">
                Latest News / Blogs
            </h3>
        </header>
    </section>
    <section class="pb-16 pt-8">
        <div class="container mx-auto">
            <div class="grid gap-x-14 gap-y-14 sm:grid-cols-3">
                @foreach ($posts as $post)
                    <a href="{{ route('post.show', ['post' => $post->slug]) }}">
                        <div class="group/blog-item flex flex-col gap-y-5">
                            <div class="h-[250px] w-full rounded-xl bg-zinc-300">
                                <img class="flex h-full w-full items-center justify-center object-cover object-top"
                                    src="{{ asset($post->cover_photo_path) }}" alt="{{ $post->photo_alt_text }}">
                            </div>
                            <div class="flex flex-col justify-between space-y-3 px-2">
                                <div>
                                    <h2 title="{{ $post->title }}"
                                        class="group-hover/blog-item:text-primary-700 mb-3 line-clamp-2 text-xl font-semibold hover:text-blue-600">
                                        {{ $post->title }}
                                    </h2>
                                    <p class="mb-3 line-clamp-3">
                                        {{ Str::limit($post->sub_title, 100) }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <img class="h-10 w-10 overflow-hidden rounded-full bg-zinc-300 object-cover text-[0]"
                                        src="{{ $post->author->avatar() }}" alt="{{ $post->author->name }}">
                                    <div>
                                        <span title="{{ $post->author->name }}"
                                            class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap text-sm font-semibold">{{ $post->author->name }}</span>
                                        <span
                                            class="block whitespace-nowrap text-sm font-medium font-semibold text-zinc-600">
                                            {{ $post->formattedPublishedDate() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-20">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

</x-blog-layout>
