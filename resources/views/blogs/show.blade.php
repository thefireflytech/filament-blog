<x-blog-layout>
    <section></section>
    <section class="pt-8 pb-16">
        <div class="container mx-auto">
            <div class="grid gap-x-20 gap-y-10 sm:grid-cols-3">
                <div class="sm:col-span-2">
                    <div class="flex flex-col justify-end">
                        <div class="rounded-xl h-full overflow-hidden bg-slate-200 w-full">
                            <img class="h-full object-cover object-top" src="{{ asset($post->cover_photo_path) }}"
                                 alt="{{ $post->photo_alt_text }}">
                        </div>
                        <div class="mt-4">
                            @foreach($post->categories as $category)
                                <span class="px-3 py-1 border text-xs font-semibold rounded-full">{{ $category->name }}</span>
                            @endforeach
                        </div>
                        <div class="py-4 flex items-center justify-between gap-x-3 mb-5">
                            {!! $shareButton?->html_code !!}
                            <div>
                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-col">
                                        <img class="w-10 h-10 rounded-full"
                                             src="{{ $post->user->avatar() }}"
                                             alt="{{ $post->user->name }}">
                                        <span>{{ $post->user->name }}</span></div>
                                    <span class="mb-2 block text-slate-500 text-sm font-medium"> {{ $post->formattedPublishedDate() }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-2xl mb-5 font-semibold">
                                {{ $post->title }}
                            </h1>
                            <div>
                                <article class="m-auto mt-12 leading-6">
                                    {!! $post->body !!}
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mb-10">
                        <div class="relative items-center flex gap-x-8 mb-2">
                            <h2 class="whitespace-nowrap text-2xl font-semibold">
                                Recent Post
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
                        <div class="relative items-center flex gap-x-8 mb-6">
                            <h2 class="whitespace-nowrap text-2xl font-semibold">
                                Related Posts
                            </h2>
                            <div class="flex w-full items-center">
                                <span class="h-0.5 w-full rounded-full bg-slate-200"></span>
                            </div>
                        </div>
                        <div class="grid gap-y-14 gap-x-12">
                            @foreach($post->relatedPosts() as $post)
                                <div>
                                    <div class="flex flex-col gap-y-5">
                                        <div class="rounded h-[200px] bg-slate-200 w-full">
                                            <img class="h-full w-full object-cover object-top"
                                                 src="{{ asset($post->cover_photo_path) }}"
                                                 alt="{{ $post->photo_alt_text }}">
                                        </div>
                                        <div class="space-y-3">
                                            <a href="{{ route('post.show', ['post' => $post->slug]) }}" class="text-xl mb-2 font-semibold hover:text-blue-600">
                                                {{ $post->title }}
                                            </a>
                                            <p class="mb-3">
                                                {{ Str::limit($post->sub_title, 100) }}
                                            </p>
                                            @foreach($post->categories as $category)
                                                <span class="px-3 py-1 border text-xs font-semibold rounded-full">{{ $category->name }}</span>
                                            @endforeach
                                            <div class="flex flex-col gap-2">
                                                <div class="flex flex-col"><img class="w-10 h-10 rounded-full"
                                                                                src="https://i.pravatar.cc/300"
                                                                                alt="{{ $post->user->name }}">
                                                    <span>{{ $post->user->name }}</span></div>
                                                <span class="mb-2 block text-slate-500 text-sm font-medium"> {{ $post->formattedPublishedDate() }}</span>
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