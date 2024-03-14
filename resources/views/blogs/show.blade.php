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
                    <div class="border-t-2 py-10">
                        <div class="mb-7">
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
                                    instruments for the UX designers. The knowledge of the design tools are as important
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
                                    instruments for the UX designers. The knowledge of the design tools are as important
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
                        <div class="mb-6">
                            <label class="flex cursor-pointer select-none items-center gap-4">
                                <input type="checkbox" class="accent-primary h-6 w-6" />
                                <span class="text-sm">
                                    Save my name and email in this browser for the next time I comment.
                                </span>
                            </label>
                        </div>
                        <div>
                            <button
                                class="bg-primary-600 hover:bg-primary-700 rounded-lg px-8 py-4 font-semibold text-white transition-all duration-300">
                                <span>Post a comment</span>
                            </button>
                        </div>
                    </div>
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
                            <x-blog-recent-post />
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
