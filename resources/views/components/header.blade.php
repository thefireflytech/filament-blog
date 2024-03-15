<header @click.outside="showSearchModal = false" x-data="{ showSearchModal: false }" class="sticky top-0 z-[94035] mb-4">
    <div class="bg-white py-7">
        <div class="container mx-auto">
            <div class="flex justify-between gap-x-4">
                <div class="flex items-center gap-x-10">
                    <a href="{{ route('post.index') }}">
                        <span class="text-2xl font-semibold text-black">
                            {{ config('app.name', 'FireFly Blog') }}
                            <strong class="text-primary-600">Blog</strong>
                        </span>
                    </a>
                    <div class="flex gap-x-10">
                        <a href="/" class="text-md font-semibold hover:text-primary-600">
                            <span>Home</span>
                        </a>
                        <a href="#" class="text-md flex items-center justify-center gap-x-2 font-semibold hover:text-primary-600">
                            <span>Categories</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19 9l-7 6l-7-6" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="ml-auto flex items-center gap-x-10">
                    <div class="relative">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-500" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="11.5" cy="11.5" r="9.5" />
                                    <path stroke-linecap="round" d="M18.5 18.5L22 22" />
                                </g>
                            </svg>
                            <input placeholder="Search query" type="text" class="w-full rounded-full border bg-white/10 px-6 py-3 pl-12 text-sm font-medium text-gray-800 placeholder-gray-400 outline-none placeholder:text-slate-500 focus:ring-0" />
                        </div>
                    </div>
                </div>
                <div>
                    {{-- <form class="flex gap-2" method="post" action="{{ route('post.subscribe') }}">
                    @csrf
                    <div class="flex flex-col">
                        <input type="text" name="email" value="{{ old('email') }}" class="flex-1 rounded-full border border-black/20 bg-transparent px-6 text-sm font-semibold outline-none focus:border focus:border-[#fdae4b]" placeholder="johdeo@email">

                        @error('email')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="border-primary-600 flex items-center gap-x-2 rounded-full border px-5 py-3 text-sm font-semibold text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12v1.45q0 1.475-1.012 2.513T18.5 17q-.875 0-1.65-.375t-1.3-1.075q-.725.725-1.638 1.088T12 17q-2.075 0-3.537-1.463T7 12q0-2.075 1.463-3.537T12 7q2.075 0 3.538 1.463T17 12v1.45q0 .65.425 1.1T18.5 15q.65 0 1.075-.45t.425-1.1V12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20h4q.425 0 .713.288T17 21q0 .425-.288.713T16 22zm0-7q1.25 0 2.125-.875T15 12q0-1.25-.875-2.125T12 9q-1.25 0-2.125.875T9 12q0 1.25.875 2.125T12 15" />
                        </svg>
                        Subscribe
                    </button>
                    @if (session('success'))
                    <span class="text-green-500">{{ session('success') }}</span>
                    @endif
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</header>