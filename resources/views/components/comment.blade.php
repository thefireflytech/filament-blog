@props(['post'])
<form action="{{ route('filamentblog.comment.store', ['post' => $post->slug]) }}" method="POST" id="comments">
    @csrf
    <div class="border-t-2 py-10">
        <div class="mb-7">
            <h3 class="mb-2 text-2xl font-semibold">Leave a reply </h3>
        </div>
        <div class="mb-6">
            <label class="mb-2 block text-sm font-semibold" for="author-comment">Comment *</label>
            <textarea name="comment" rows="4" placeholder="Write your message here" type="text" id="author-comment"
                      class="form-input relative block w-full rounded-md border-0 bg-white px-4 py-4 text-sm text-gray-900 placeholder-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black disabled:cursor-not-allowed disabled:opacity-75 dark:bg-gray-900 dark:text-white dark:placeholder-gray-500 dark:ring-gray-700"></textarea>
            @error('comment')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            @if (session('success'))
                <span class="text-green-500">{{ session('success') }}</span>
            @endif
        </div>
        <div>
            @if(auth()->user()?->canComment())
                <button type="submit"
                        class="g-recaptcha bg-primary-600 hover:bg-primary-700 rounded-lg px-8 py-4 font-semibold text-white transition-all duration-300"
                        @if(config('filamentblog.recaptcha.enabled')) data-sitekey="{{ config('filamentblog.recaptcha.site_key') }}"
                        @endif
                        data-callback='onSubmit'
                        data-action='submit'
                >
                    <span>Post a comment</span>
                </button>
            @else
                <a
                        href="{{ route(config('filamentblog.route.login.name')) }}"
                        class="bg-primary-600 hover:bg-primary-700 rounded-lg px-8 py-4 font-semibold text-white transition-all duration-300">
                    <span>Login</span>
                </a>
            @endif
        </div>
    </div>
</form>
