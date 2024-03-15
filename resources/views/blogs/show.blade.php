<x-blog-layout>
    <section class="pb-16">
        <div class="container mx-auto">
            <div class="grid gap-x-20 gap-y-10 sm:grid-cols-3">
                <div class="space-y-10 sm:col-span-2">
                    <div>
                        <div class="mb-10 flex gap-x-2 text-sm font-semibold">
                            <span class="opacity-60">Home</span>
                            <span class="opacity-30">/</span>
                            <a href="{{ route('post.index') }}" class="opacity-60">Blog</a>
                            <span class="opacity-30">/</span>
                            <a title="{{ $post->slug }}" href="{{ route('post.show', ['post' => $post->slug]) }}"
                               class="hover:text-primary-600 max-w-2xl truncate font-medium transition-all duration-300">
                                {{ $post->title }}
                            </a>
                        </div>

                        <div class="mb-6">
                            <h1 class="mb-2 text-3xl font-semibold">
                                {{ $post->title }}
                            </h1>
                        </div>
                        <div class="flex flex-col justify-end">
                            <div class="h-full w-full overflow-hidden rounded-xl bg-slate-200">
                                <img class="flex h-full min-h-[400px] items-center justify-center object-cover object-top text-sm"
                                     src="{{ asset($post->cover_photo_path) }}" alt="{{ $post->photo_alt_text }}">
                            </div>
                            <div class="mt-4">
                                @foreach ($post->categories as $category)
                                    <span
                                            class="bg-primary-200 text-primary-800 mr-2 inline-flex rounded-full px-2 py-1 text-xs font-semibold">{{ $category->name }}</span>
                                @endforeach
                            </div>
                            <div class="mb-5 flex items-center justify-between gap-x-3 py-4">
                                <div>
                                    <div class="flex items-center gap-4">
                                        <img class="h-14 w-14 overflow-hidden rounded-full border-4 border-white bg-zinc-300 object-cover text-[0] ring-1 ring-slate-300"
                                             src="{{ $post->author->avatar() }}" alt="{{ $post->author->name }}">
                                        <div>
                                            <span title="{{ $post->author->name }}"
                                                  class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap font-semibold">{{ $post->author->name }}</span>
                                            <span
                                                    class="block whitespace-nowrap text-sm font-medium font-semibold text-zinc-600">
                                                {{ $post->formattedPublishedDate() }}</span>
                                        </div>
                                    </div>
                                </div>
                                {!! $shareButton?->html_code !!}
                            </div>
                            <div>
                                <article class="m-auto leading-6">
                                    {!! $post->body !!}
                                </article>

                                @if($post->tags->count())
                                <div class="pt-10">
                                    <span class="mb-3 block font-semibold">Tags</span>
                                    <div class="space-x-2 space-y-1">
                                        @foreach ($post->tags as $tag)
                                            <a href=""
                                               class="rounded-full border border-slate-300 px-3 py-1 text-sm font-medium font-medium text-black text-slate-600 hover:bg-slate-100">
                                                {{$tag->title}}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{--         Comment           --}}
{{--                    <x-blog-comment/>--}}
                    {{--         Comment          --}}

                </div>
                <div>
                    <div class="mb-10">
                        <div class="relative mb-2 flex items-center gap-x-8">
                            <h2 class="whitespace-nowrap text-xl font-semibold">
                                <span class="text-primary font-bold">#</span> Recent Post
                            </h2>
                            <div class="flex w-full items-center">
                                <span class="h-0.5 w-full rounded-full bg-slate-200"></span>
                            </div>
                        </div>
                        <div class="flex flex-col divide-y">
                            <x-blog-recent-post/>
                        </div>
                    </div>
                    <div>
                        <div class="relative mb-6 flex items-center gap-x-8">
                            <h2 class="whitespace-nowrap text-xl font-semibold">
                                <span class="text-primary font-bold">#</span> Related Posts
                            </h2>
                            <div class="flex w-full items-center">
                                <span class="h-0.5 w-full rounded-full bg-slate-200"></span>
                            </div>
                        </div>
                        <div class="grid gap-x-12 gap-y-10">
                            @foreach ($post->relatedPosts() as $post)
                                <div>
                                    <div class="flex flex-col gap-y-2">
                                        <div class="h-[200px] w-full overflow-hidden rounded-lg bg-slate-200">
                                            <img class="flex h-full w-full items-center justify-center object-cover object-top text-slate-400"
                                                 src="{{ asset($post->cover_photo_path) }}"
                                                 alt="{{ $post->photo_alt_text }}">
                                        </div>
                                        <div class="space-y-3">
                                            <a title="{{ $post->title }}"
                                               href="{{ route('post.show', ['post' => $post->slug]) }}"
                                               class="hover:text-primary-700 mb-2 line-clamp-2 text-lg font-medium">
                                                {{ $post->title }}
                                            </a>
                                            <div class="flex items-center gap-2 text-slate-500">
                                                <div class="flex items-center gap-x-2">
                                                    <span title="{{ $post->author->name }}"
                                                          class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap text-sm font-medium">{{ $post->author->name }}</span>
                                                </div>
                                                <samp>/</samp>
                                                <span class="block text-sm font-medium font-medium">
                                                    {{ $post->formattedPublishedDate() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {!! $shareButton?->script_code !!}
</x-blog-layout>
