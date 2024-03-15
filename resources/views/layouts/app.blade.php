<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! \Artesaos\SEOTools\Facades\SEOMeta::generate() !!}

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
        article p {
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 2rem;
        }

        article h1 {
            font-size: 2.5rem;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        article h2 {
            font-size: 2rem;
            line-height: 1.3;
            margin-bottom: 0.5rem;
        }

        article h3 {
            font-size: 1.75rem;
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }

        article h4 {
            font-size: 1.5rem;
            line-height: 1.5;
            margin-bottom: 0.5rem;
        }

        article h5 {
            font-size: 1.25rem;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }

        article h6 {
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body class="antialiased">
    <div class="min-h-screen">
        <!-- Page Header -->
        <x-blog-header />
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="w-full border-t px-5 py-12">
            <div class="container mx-auto">
                <div class="mb-4">
                    <div class="grid items-start justify-between gap-x-40 gap-y-10 sm:grid-cols-5">
                        <div class="col-span-2 flex flex-col items-start gap-3 py-3">
                            <h4 class="text-xl font-semibold">Filament Blog</h4>
                            <p class="text-base">
                                Your hub for all things Laravel blog plugins. Discover the latest tips, tutorials, and
                                insights to enhance your Laravel blog development.
                            </p>
                        </div>
                        <div class="flex flex-col items-start gap-3 py-3 text-sm font-medium">
                            <h4 class="text-xl font-semibold">Categories</h4>
                            <a href="#"
                                class="transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none">
                                Home
                            </a>
                            <a href="#"
                                class="transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none">
                                Documentation
                            </a>
                            <a href="#"
                                class="transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none">
                                Recent Posts
                            </a>
                        </div>
                        <div class="col-span-2 flex flex-col items-start gap-3 text-sm font-medium">
                            <div class="relative overflow-hidden rounded-2xl bg-slate-100 px-6 py-4 text-black">
                                <div class="mb-3 pb-2 text-xl font-semibold">
                                    Subscribe to our Newsletter
                                </div>
                                <div>
                                    <p class="mb-3 block text-slate-500">
                                        Subscribe to our mailing list to receives daily updates direct to your inbox!
                                    </p>
                                    <div>
                                        <form action="" class="w-100 relative">
                                            <label class="hidden" for="email-address">Email</label>
                                            <input autocomplete="email"
                                                class="flex w-full items-center justify-between rounded-xl border bg-white px-6 py-5 font-medium text-black outline-none placeholder:text-black"
                                                name="email-address" placeholder="Enter your email" type="email">
                                            <button class="absolute right-4 top-1/2 -translate-y-1/2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary-600 h-8 w-8"
                                                    viewBox="0 0 256 256">
                                                    <path fill="currentColor"
                                                        d="m220.24 132.24l-72 72a6 6 0 0 1-8.48-8.48L201.51 134H40a6 6 0 0 1 0-12h161.51l-61.75-61.76a6 6 0 0 1 8.48-8.48l72 72a6 6 0 0 1 0 8.48" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <i
                                        class="bi bi-envelope pointer-events-none absolute -right-10 -top-20 text-[9rem] opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-7 flex flex-wrap items-start justify-between gap-10 border-t border-slate-200 pt-5">
                    <div class="text-hurricane/50 text-sm font-medium">
                        © 2024 Filament Blog. All rights reserved.
                    </div>
                    <div class="flex flex-wrap items-center gap-5">
                        <a target="_blank" href="#"
                            class="grid place-items-center rounded-xl hover:text-black motion-reduce:transition-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 16 16"
                                class="absolute right-1/2 top-1/2 -translate-y-1/2 translate-x-1/2 scale-0 opacity-0 transition duration-300 group-hover/twitter-link:scale-100 group-hover/twitter-link:opacity-100"
                                fill="none">
                                <path
                                    d="M12.6182 0.80542H15.0592L9.72628 6.90056L16 15.1947H11.0877L7.24026 10.1643L2.83789 15.1947H0.395405L6.09945 8.67524L0.0810547 0.80542H5.11803L8.5958 5.40334L12.6182 0.80542ZM11.7614 13.7336H13.114L4.38307 2.18974H2.9316L11.7614 13.7336Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>
                        <a target="_blank" href="#"
                            class="grid place-items-center rounded-xl hover:text-black motion-reduce:transition-none">
                            <svg class="w-8" fill="none" viewBox="0 0 71 55" aria-hidden="true">
                                <g clip-path="url(#clip0)">
                                    <path
                                        d="M60.1045 4.8978C55.5792 2.8214 50.7265 1.2916 45.6527 0.41542C45.5603 0.39851 45.468 0.440769 45.4204 0.525289C44.7963 1.6353 44.105 3.0834 43.6209 4.2216C38.1637 3.4046 32.7345 3.4046 27.3892 4.2216C26.905 3.0581 26.1886 1.6353 25.5617 0.525289C25.5141 0.443589 25.4218 0.40133 25.3294 0.41542C20.2584 1.2888 15.4057 2.8186 10.8776 4.8978C10.8384 4.9147 10.8048 4.9429 10.7825 4.9795C1.57795 18.7309 -0.943561 32.1443 0.293408 45.3914C0.299005 45.4562 0.335386 45.5182 0.385761 45.5576C6.45866 50.0174 12.3413 52.7249 18.1147 54.5195C18.2071 54.5477 18.305 54.5139 18.3638 54.4378C19.7295 52.5728 20.9469 50.6063 21.9907 48.5383C22.0523 48.4172 21.9935 48.2735 21.8676 48.2256C19.9366 47.4931 18.0979 46.6 16.3292 45.5858C16.1893 45.5041 16.1781 45.304 16.3068 45.2082C16.679 44.9293 17.0513 44.6391 17.4067 44.3461C17.471 44.2926 17.5606 44.2813 17.6362 44.3151C29.2558 49.6202 41.8354 49.6202 53.3179 44.3151C53.3935 44.2785 53.4831 44.2898 53.5502 44.3433C53.9057 44.6363 54.2779 44.9293 54.6529 45.2082C54.7816 45.304 54.7732 45.5041 54.6333 45.5858C52.8646 46.6197 51.0259 47.4931 49.0921 48.2228C48.9662 48.2707 48.9102 48.4172 48.9718 48.5383C50.038 50.6034 51.2554 52.5699 52.5959 54.435C52.6519 54.5139 52.7526 54.5477 52.845 54.5195C58.6464 52.7249 64.529 50.0174 70.6019 45.5576C70.6551 45.5182 70.6887 45.459 70.6943 45.3942C72.1747 30.0791 68.2147 16.7757 60.1968 4.9823C60.1772 4.9429 60.1437 4.9147 60.1045 4.8978ZM23.7259 37.3253C20.2276 37.3253 17.3451 34.1136 17.3451 30.1693C17.3451 26.225 20.1717 23.0133 23.7259 23.0133C27.308 23.0133 30.1626 26.2532 30.1066 30.1693C30.1066 34.1136 27.28 37.3253 23.7259 37.3253ZM47.3178 37.3253C43.8196 37.3253 40.9371 34.1136 40.9371 30.1693C40.9371 26.225 43.7636 23.0133 47.3178 23.0133C50.9 23.0133 53.7545 26.2532 53.6986 30.1693C53.6986 34.1136 50.9 37.3253 47.3178 37.3253Z"
                                        fill="currentColor"></path>
                                </g>
                            </svg>
                        </a>
                        <a target="_blank" href="#"
                            class="grid place-items-center rounded-xl hover:text-black motion-reduce:transition-none">
                            <svg class="w-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
