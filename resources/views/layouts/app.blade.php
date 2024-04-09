<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ $setting?->faviconImage }}" type="image/x-icon" />
    {!! \Firefly\FilamentBlog\Facades\SEOMeta::generate() !!}
    {!! $setting?->google_console_code !!}
    {!! $setting?->google_analytic_code !!}
    {!! $setting?->google_adsense_code !!}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                container: {
                    padding: '2rem',
                    screen: {
                        '2xl': '1200px'
                    }
                },
                extend: {
                    colors: {
                        'primary': {
                            DEFAULT: '#FDAE4B',
                            50: '#fff9f5',
                            100: '#FFF7EC',
                            200: '#FEE4C4',
                            300: '#FED29C',
                            400: '#FDC073',
                            500: '#FDAE4B',
                            600: '#FC9514',
                            700: '#D57802',
                            800: '#9E5902',
                            900: '#663901',
                            950: '#4B2A01'
                        },
                        'rum': {
                            DEFAULT: '#6C6489',
                            50: '#FFFFFF',
                            100: '#FFFFFF',
                            200: '#F0EFF3',
                            300: '#D9D7E2',
                            400: '#C3C0D1',
                            500: '#ADA8BF',
                            600: '#9790AE',
                            700: '#81799D',
                            800: '#6C6489',
                            900: '#524C69',
                            950: '#464058'
                        },
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: "Poppins", serif;
            font-weight: 400;
            font-style: normal;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
    </style>
    <style>
        /* Blog Posts */
        article h1 {
            line-height: 1.2;
            font-size: 2rem;
            color: #424242;
            font-weight: 900;
            padding-bottom: 20px;
        }

        article h2 {
            line-height: 1.2;
            font-size: 1.5rem;
            color: #424242;
            font-weight: 800;
            padding-bottom: 10px;
        }

        article h3 {
            line-height: 1.2;
            font-size: 1.25rem;
            color: #424242;
            font-weight: 700;
            padding-bottom: 10px;
        }

        article h4 {
            line-height: 1.2;
            font-size: 1.2rem;
            color: #424242;
            font-weight: 600;
            padding-bottom: 10px;
        }

        article p {
            line-height: 1.75;
            letter-spacing: .2px;
            font-size: 1rem;
            color: #424242;
            font-weight: 400;
            margin-bottom: 1rem;
        }

        article ul {
            line-height: 1.7;
            padding-bottom: 5px;
        }

        article table {
            margin-top: 2rem;
            margin-bottom: 2rem;
            border-radius: 10px;
        }

        article table,
        article table td,
        article table th {
            border: 1px solid #ccc;
            padding: 5px 10px;
        }

        /* share this */
        .sharethis-inline-share-buttons {
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
        }

        .sharethis-inline-share-buttons .st-btn {
            width: 50px !important;
            height: 50px !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            margin-bottom: 10px !important;
            border-radius: 50px !important;
            margin-right: 0 !important
        }

        .sharethis-inline-share-buttons .st-btn img {
            top: 0 !important
        }
    </style>
</head>

<body class="antialiased">
    <div class="min-h-screen">
        <!-- Page Header -->
        <x-blog-header title="{{ $setting?->title }}" logo="{{ $setting?->logoImage }}" />
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="mt-10 w-full border-t px-5 py-12">
            <div class="container mx-auto">
                <div class="mb-4">
                    <div class="grid justify-between gap-x-10 gap-y-10 sm:grid-cols-3">
                        <div class="flex flex-col items-start gap-3 py-3">
                            <h4 class="text-xl font-semibold">{{ $setting?->title }}</h4>
                            <p class="text-base">
                                {{ $setting?->description }}
                            </p>
                        </div>
                        <div class="grid sm:grid-cols-2 col-span-2">
                            <div class="md:flex md:flex-col grid gap-3 py-3 text-sm font-medium">
                                <h4 class="text-xl font-semibold">Quick Links</h4>
                                @forelse($setting->quick_links ?? [] as $link)
                                    <a href="{{ $link['url'] }}"
                                        class="transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none">
                                        {{ $link['label'] }}
                                    </a>
                                @empty
                                    <p class="font-semibold text-gray-300">No links found</p>
                                @endforelse
                            </div>
                            <div class="flex flex-col items-start gap-3 text-sm font-medium">
                                <div class="relative overflow-hidden rounded-2xl bg-slate-100 px-6 py-4 text-black">
                                    <div class="mb-3 pb-2 text-xl font-semibold">
                                        Subscribe to our Newsletter
                                    </div>
                                    <div>
                                        <p class="mb-3 block text-slate-500">
                                            Subscribe to our mailing list to receive daily updates direct to your inbox!
                                        </p>
                                        <div>
                                            <form method="post" action="{{ route('filamentblog.post.subscribe') }}">
                                                @csrf
                                                <label hidden for="email-address">Email</label>
                                                @error('email')
                                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                                @enderror
                                                <div class="w-100 relative">
                                                    <input autocomplete="email"
                                                        class="flex w-full items-center justify-between rounded-xl border bg-white px-6 py-5 font-medium text-black outline-none placeholder:text-black"
                                                        name="email" value="{{ old('email') }}"
                                                        placeholder="Enter your email" type="email">
                                                    <button type="submit"
                                                        class="absolute right-4 top-1/2 -translate-y-1/2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-primary h-8 w-8"
                                                            viewBox="0 0 256 256">
                                                            <path fill="currentColor"
                                                                d="m220.24 132.24l-72 72a6 6 0 0 1-8.48-8.48L201.51 134H40a6 6 0 0 1 0-12h161.51l-61.75-61.76a6 6 0 0 1 8.48-8.48l72 72a6 6 0 0 1 0 8.48" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                @if (session('success'))
                                                    <span class="text-green-500">{{ session('success') }}</span>
                                                @endif
                                            </form>
                                        </div>
                                        <i
                                            class="bi bi-envelope pointer-events-none absolute -right-10 -top-20 text-[9rem] opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-7 flex flex-wrap items-start justify-center gap-10 border-t border-slate-200 pt-5">
                    <div class="text-hurricane/50 text-sm font-medium">
                        © 2024 {{ $setting->organization_name ?? 'Firefly Blog' }}. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <div class="fixed bottom-0 left-0 z-50 h-20 w-full border-t border-gray-200 bg-white sm:hidden">
            <div class="mx-auto grid h-full max-w-lg grid-cols-2 justify-center font-medium">
                <a href="{{ route('filamentblog.post.index') }}"
                    class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-1 w-6" viewBox="0 0 256 256">
                        <path fill="currentColor"
                            d="m217.47 105.24l-80-75.5l-.09-.08a13.94 13.94 0 0 0-18.83 0l-.09.08l-80 75.5A14 14 0 0 0 34 115.55V208a14 14 0 0 0 14 14h48a14 14 0 0 0 14-14v-48a2 2 0 0 1 2-2h32a2 2 0 0 1 2 2v48a14 14 0 0 0 14 14h48a14 14 0 0 0 14-14v-92.45a14 14 0 0 0-4.53-10.31M210 208a2 2 0 0 1-2 2h-48a2 2 0 0 1-2-2v-48a14 14 0 0 0-14-14h-32a14 14 0 0 0-14 14v48a2 2 0 0 1-2 2H48a2 2 0 0 1-2-2v-92.45a2 2 0 0 1 .65-1.48l.09-.08l79.94-75.48a2 2 0 0 1 2.63 0L209.26 114l.08.08a2 2 0 0 1 .66 1.48Z" />
                    </svg>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600 dark:text-gray-400">Home</span>
                </a>
                <a href="{{ route('filamentblog.post.all') }}"
                    class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-1 w-6" viewBox="0 0 256 256">
                        <path fill="currentColor"
                            d="M216 40H40a16 16 0 0 0-16 16v160a8 8 0 0 0 11.58 7.15L64 208.94l28.42 14.21a8 8 0 0 0 7.16 0L128 208.94l28.42 14.21a8 8 0 0 0 7.16 0L192 208.94l28.42 14.21A8 8 0 0 0 232 216V56a16 16 0 0 0-16-16m0 163.06l-20.42-10.22a8 8 0 0 0-7.16 0L160 207.06l-28.42-14.22a8 8 0 0 0-7.16 0L96 207.06l-28.42-14.22a8 8 0 0 0-7.16 0L40 203.06V56h176ZM136 112a8 8 0 0 1 8-8h48a8 8 0 0 1 0 16h-48a8 8 0 0 1-8-8m0 32a8 8 0 0 1 8-8h48a8 8 0 0 1 0 16h-48a8 8 0 0 1-8-8m-72 24h48a8 8 0 0 0 8-8V96a8 8 0 0 0-8-8H64a8 8 0 0 0-8 8v64a8 8 0 0 0 8 8m8-64h32v48H72Z" />
                    </svg>
                    <span class="text-sm text-gray-500 group-hover:text-blue-600 dark:text-gray-400">All Posts</span>
                </a>
            </div>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("comment-box").submit();
        }
    </script>
</body>

</html>
