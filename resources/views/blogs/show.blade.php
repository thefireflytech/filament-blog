<x-blog-layout>
    <section class="pb-16">
        <div class="container mx-auto">
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
            <div class="mx-auto mb-20 space-y-10">
                <div class="grid gap-x-20 sm:grid-cols-[minmax(min-content,10%)_1fr_minmax(min-content,10%)]">
                    <div class="py-5">
                        <div class="sticky top-24 flex flex-col items-center gap-y-5 divide-y-2">
                            <button x-data=""
                                x-on:click="document.getElementById('comments').scrollIntoView({ behavior: 'smooth'})"
                                class="group/btn flex flex-col items-center justify-center gap-y-2">
                                <div
                                    class="flex items-center justify-center rounded-full bg-slate-100 px-4 py-4 group-hover/btn:bg-slate-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M13 11H7a1 1 0 0 0 0 2h6a1 1 0 0 0 0-2m4-4H7a1 1 0 0 0 0 2h10a1 1 0 0 0 0-2m2-5H5a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h11.59l3.7 3.71A1 1 0 0 0 21 22a.84.84 0 0 0 .38-.08A1 1 0 0 0 22 21V5a3 3 0 0 0-3-3m1 16.59l-2.29-2.3A1 1 0 0 0 17 16H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1Z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold">COMMENTS</span>
                            </button>
                            <div class="pt-5">
                                {!! $shareButton?->html_code !!}
                            </div>
                        </div>
                    </div>
                    <div class="space-y-10">
                        <div>
                            <div class="flex flex-col justify-end">
                                <div class="mb-6 h-full w-full overflow-hidden rounded bg-slate-200">
                                    <img class="flex h-full min-h-[400px] items-center justify-center object-cover object-top text-sm text-xl font-semibold text-slate-400"
                                        src="{{ asset($post->cover_photo_path) }}" alt="{{ $post->photo_alt_text }}">
                                </div>
                                <div class="mb-6">
                                    <h1 class="mb-6 text-4xl font-semibold">
                                        {{ $post->title }}
                                    </h1>
                                    <div class="mt-2">
                                        @foreach ($post->categories as $category)
                                            <span
                                                class="bg-primary-200 text-primary-800 mr-2 inline-flex rounded-full px-2 py-1 text-xs font-semibold">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-5 flex items-center justify-between gap-x-3 py-5">
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
                                </div>
                                <div>
                                    <article class="m-auto leading-6">
                                        {!! $post->body !!}
                                    </article>

                                    <div class="pt-10">
                                        <span class="mb-3 block font-semibold">Tags</span>
                                        <div class="space-x-2 space-y-1">
                                            @foreach ($post->categories as $category)
                                                <a href=""
                                                    class="rounded-full border border-slate-300 px-3 py-1 text-sm font-medium font-medium text-black text-slate-600 hover:bg-slate-100">
                                                    Tag 1
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-t-2 py-10" id="comments">
                            <div class="mb-4">
                                <h3 class="mb-2 text-2xl font-semibold">Comments</h3>
                            </div>
                            <div class="flex flex-col gap-y-6 divide-y">
                                <article class="pt-4 text-base">
                                    <div class="mb-4 flex items-center gap-4">
                                        <img class="h-14 w-14 overflow-hidden rounded-full border-4 border-white bg-zinc-300 object-cover text-[0] ring-1 ring-slate-300"
                                            src="" alt="avatar">
                                        <div>
                                            <span
                                                class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap font-semibold">
                                                Michael Gough
                                            </span>
                                            <span class="block whitespace-nowrap text-sm font-medium text-zinc-600">
                                                Feb. 8, 2022
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-gray-500">
                                        Very straight-to-point article. Really worth
                                        time reading. Thank you! But tools are just the
                                        instruments for the UX designers. The knowledge of the design tools are as
                                        important
                                        as he creation of the design strategy.
                                    </p>
                                </article>
                                <article class="pt-4 text-base">
                                    <div class="mb-4 flex items-center gap-4">
                                        <img class="h-14 w-14 overflow-hidden rounded-full border-4 border-white bg-zinc-300 object-cover text-[0] ring-1 ring-slate-300"
                                            src="" alt="avatar">
                                        <div>
                                            <span
                                                class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap font-semibold">
                                                Michael Gough
                                            </span>
                                            <span class="block whitespace-nowrap text-sm font-medium text-zinc-600">
                                                Feb. 8, 2022
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-gray-500">
                                        Very straight-to-point article. Really worth
                                        time reading. Thank you! But tools are just the
                                        instruments for the UX designers. The knowledge of the design tools are as
                                        important
                                        as he creation of the design strategy.
                                    </p>
                                </article>
                            </div>
                        </div>
                        <div class="border-t-2 py-10">
                            <div class="mb-7">
                                <h3 class="mb-2 text-2xl font-semibold">Leave a Reply </h3>
                                <p>Your email address will not be published. Required fields are marked *</p>
                            </div>
                            <div class="mb-6">
                                <label class="mb-2 block text-sm font-semibold" for="author-comment">Comment *</label>
                                <textarea rows="4" placeholder="Write your message here" type="text" id="author-comment"
                                    class="form-input relative block w-full rounded-md border-0 bg-white px-4 py-4 text-sm text-gray-900 placeholder-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black disabled:cursor-not-allowed disabled:opacity-75 dark:bg-gray-900 dark:text-white dark:placeholder-gray-500 dark:ring-gray-700"></textarea>
                            </div>
                            <div class="mb-6 grid gap-8 sm:grid-cols-2">
                                <div>
                                    <label class="mb-2 block text-sm font-semibold" for="author-comment">Name *</label>
                                    <input placeholder="Your Name"
                                        class="form-input relative block w-full rounded-md border-0 bg-white px-4 py-4 text-sm text-gray-900 placeholder-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black disabled:cursor-not-allowed disabled:opacity-75 dark:bg-gray-900 dark:text-white dark:placeholder-gray-500 dark:ring-gray-700"
                                        type="text" />
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-semibold" for="author-comment">Email *</label>
                                    <input placeholder="authorname@domain.com"
                                        class="form-input relative block w-full rounded-md border-0 bg-white px-4 py-4 text-sm text-gray-900 placeholder-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black disabled:cursor-not-allowed disabled:opacity-75 dark:bg-gray-900 dark:text-white dark:placeholder-gray-500 dark:ring-gray-700"
                                        type="email" />
                                </div>
                            </div>
                            <div class="mb-8">
                                <label class="flex cursor-pointer select-none items-center gap-4">
                                    <input type="checkbox" class="accent-primary h-6 w-6" />
                                    <span class="text-sm">
                                        Save my name and email in this browser for the next time I comment.
                                    </span>
                                </label>
                            </div>
                            <div>
                                <button
                                    class="bg-primary-600 hover:bg-primary-700 rounded-lg px-8 py-4 text-sm font-semibold text-white transition-all duration-300">
                                    <span>Post a comment</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="sticky top-24 flex h-[600px] w-[160px] items-center justify-center overflow-hidden rounded bg-slate-200 font-medium text-slate-500/20">
                            <span>ADS</span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div>
                    <div class="relative mb-6 flex items-center gap-x-8">
                        <h2 class="whitespace-nowrap text-xl font-semibold">
                            <span class="text-primary font-bold">#</span> Related Posts
                        </h2>
                        <div class="flex w-full items-center">
                            <span class="h-0.5 w-full rounded-full bg-slate-200"></span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-x-12 gap-y-10">
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
                    <div class="flex justify-center pt-20">
                        <a href="{{ route('post.all') }}"
                            class="flex items-center justify-center gap-x-5 rounded-full bg-slate-100 px-20 py-4 text-sm font-semibold transition-all duration-300 hover:bg-slate-200">
                            <span>Show all blogs</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6m0 0H9m9 0v9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {!! $shareButton?->script_code !!}
</x-blog-layout>
