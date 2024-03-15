<x-blog-layout>
    <section class="py-8">
        <div class="container mx-auto">
            <div class="">
                {{-- Hero Post      --}}
                @foreach ($posts->take(1) as $post)
                <div>
                    <div class="grid grid-cols-2 gap-x-10">
                        <div class="h-[400px] w-full overflow-hidden rounded-xl bg-zinc-300">
                            <img class="flex h-full w-full items-center justify-center object-cover object-top" src="{{ asset($post->cover_photo_path) }}" alt="{{ $post->photo_alt_text }}">
                        </div>
                        <div class="flex flex-col justify-center space-y-10 py-4 sm:pl-10">
                            <div>
                                <div class="mb-5">
                                    <a href="{{ route('post.show', ['post' => $post->slug]) }}" class="hover:text-primary-700 mb-4 block text-4xl font-semibold hover:text-blue-600">
                                        {{ $post->title }}
                                    </a>
                                    <div>
                                        @foreach ($post->categories as $category)
                                        <span class="bg-primary-200 text-primary-800 mr-2 inline-flex rounded-full px-2 py-1 text-xs font-semibold">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <p class="mb-4">
                                    {!! Str::limit($post->sub_title) !!}
                                </p>
                            </div>
                            <div class="flex items-center gap-4">
                                <img class="h-14 w-14 overflow-hidden rounded-full bg-zinc-300 object-cover text-[0]" src="{{ $post->author->avatar() }}" alt="{{ $post->author->name }}">
                                <div>
                                    <span title="{{ $post->author->name }}" class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap font-semibold">{{ $post->author->name }}</span>
                                    <span class="block whitespace-nowrap text-sm font-medium font-semibold text-zinc-600">
                                        {{ $post->formattedPublishedDate() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- Hero Post      --}}
            </div>
        </div>
    </section>
    <section class="pb-16 pt-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-3 gap-x-14 gap-y-14">
                @foreach ($posts->skip(1) as $post)
                <a href="{{ route('post.show', ['post' => $post->slug]) }}">
                    <div class="group/blog-item flex flex-col gap-y-5">
                        <div class="h-[250px] w-full rounded-xl bg-zinc-300">
                            <img class="flex h-full w-full items-center justify-center object-cover object-top" src="{{ asset($post->cover_photo_path) }}" alt="{{ $post->photo_alt_text }}">
                        </div>
                        <div class="flex flex-col justify-between space-y-3 px-2">
                            <div>
                                <h2 title="{{ $post->title }}" class="group-hover/blog-item:text-primary-700 mb-3 line-clamp-2 text-xl font-semibold hover:text-blue-600">
                                    {{ $post->title }}
                                </h2>
                                <p class="mb-3 line-clamp-3">
                                    {{ Str::limit($post->sub_title, 100) }}
                                </p>
                            </div>
                            <div class="flex items-center gap-4">
                                <img class="h-10 w-10 overflow-hidden rounded-full bg-zinc-300 object-cover text-[0]" src="{{ $post->author->avatar() }}" alt="{{ $post->author->name }}">
                                <div>
                                    <span title="{{ $post->author->name }}" class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap text-sm font-semibold">{{ $post->author->name }}</span>
                                    <span class="block whitespace-nowrap text-sm font-medium font-semibold text-zinc-600">
                                        {{ $post->formattedPublishedDate() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

</x-blog-layout>