<x-blog-layout>
    <section></section>
    <section class="pt-8 pb-16">
        <div class="container mx-auto">
            <div class="">
                {{--      Hero Post      --}}
                @foreach($posts->take(1) as $post)
                    <div>
                        <div class="flex gap-x-5">
                            <div class="rounded-xl overflow-hidden h-[300px] bg-slate-200 w-full">
                                <img class="h-full w-full object-cover object-top"
                                     src="{{ asset($post->cover_photo_path) }}"
                                     alt="{{ $post->photo_alt_text }}">
                            </div>
                            <div class="space-y-3 flex flex-col justify-between py-4">
                                <div>
                                    <a href="{{ route('post.show', ['post' => $post->slug]) }}"
                                       class="text-xl mb-2 font-semibold hover:text-blue-600">
                                        {{ $post->title }}
                                    </a>
                                    <div>
                                        @foreach($post->categories as $category)
                                            <span class="px-3 py-1 border text-xs font-semibold rounded-full">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                    <p class="mb-3">
                                        {!! Str::limit($post->sub_title) !!}
                                    </p>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-col">
                                        <img class="w-10 h-10 rounded-full"
                                             src="{{ $post->author->avatar() }}"
                                             alt="{{ $post->author->name }}">
                                        <span>{{ $post->author->name }}</span></div>
                                    <span class="mb-2 block text-slate-500 text-sm font-medium"> {{ $post->formattedPublishedDate() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                {{--      Hero Post      --}}
            </div>
        </div>
    </section>
    <section class="pt-8 pb-16">
        <div class="container mx-auto">
            <div class="relative items-center flex gap-x-8 mb-6">
                <h2 class="whitespace-nowrap text-2xl font-semibold">
                    All Blog Posts
                </h2>
                <div class="flex w-full items-center">
                    <span class="h-0.5 w-full rounded-full bg-slate-200"></span>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-y-14 gap-x-12">
                @foreach($posts->skip(1) as $post)
                    <div>
                        <div class="flex flex-col gap-y-5">
                            <div class="rounded h-[200px] bg-slate-200 w-full">
                                <img class="h-full w-full object-cover object-top"
                                     src="{{ asset($post->cover_photo_path) }}"
                                     alt="{{ $post->photo_alt_text }}">
                            </div>
                            <div class="space-y-3">
                                <a href="{{ route('post.show', ['post' => $post->slug]) }}"
                                   class="text-xl mb-2 font-semibold hover:text-blue-600">
                                    {{ $post->title }}
                                </a>
                                <p class="mb-3">
                                    {{ Str::limit($post->sub_title, 100) }}
                                </p>
                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-col">
                                        <img class="w-10 h-10 rounded-full"
                                             src="{{ $post->author->avatar() }}"
                                             alt="{{ $post->author->name }}">
                                        <span>{{ $post->author->name }}</span></div>
                                    <span class="mb-2 block text-slate-500 text-sm font-medium"> {{ $post->formattedPublishedDate() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-blog-layout>

