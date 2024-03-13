<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! \Artesaos\SEOTools\Facades\SEOMeta::generate() !!}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');

        body {
            font-family: "Plus Jakarta Sans", serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>

<body class="font-sans antialiased font-jakarta" style="font-family:'Plus Jakarta Sans' ">
    <div class="min-h-screen bg-gray-100">
        <!-- Page Header -->
        <header class="py-5 mb-4 border-b border-slate-200">
            <div class="container mx-auto">
                <div class="flex justify-between gap-x-4">
                    <div class="flex items-center">
                        <a href="{{ route('post.index') }}">
                            <span class="text-2xl">{{ config('app.name', 'FireFly Blog') }} <strong>Blog</strong></span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="flex gap-x-4">
                            <a href="/" class="text-lg font-medium hover:text-blue-600">
                                <span>Home</span>
                            </a>
                            <a href="#" class="text-lg font-medium hover:text-blue-600">
                                <span>Categories</span>
                            </a>
                        </div>
                    </div>
                    <div>
                        <form class="flex gap-2" method="post" action="{{ route('post.subscribe') }}">
                            @csrf
                            <div class="flex flex-col ">
                                <input type="text" name="email" value="{{old('email')}}" class="rounded-full border px-6 flex-1" placeholder="johdeo@email">

                                @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="flex gap-x-2 items-center py-3 px-5 bg-blue-500 hover:bg-blue-600 text-white rounded-full font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12v1.45q0 1.475-1.012 2.513T18.5 17q-.875 0-1.65-.375t-1.3-1.075q-.725.725-1.638 1.088T12 17q-2.075 0-3.537-1.463T7 12q0-2.075 1.463-3.537T12 7q2.075 0 3.538 1.463T17 12v1.45q0 .65.425 1.1T18.5 15q.65 0 1.075-.45t.425-1.1V12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20h4q.425 0 .713.288T17 21q0 .425-.288.713T16 22zm0-7q1.25 0 2.125-.875T15 12q0-1.25-.875-2.125T12 9q-1.25 0-2.125.875T9 12q0 1.25.875 2.125T12 15" />
                                </svg>
                                Subscribe
                            </button>
                            @if(session('success'))
                            <span class="text-green-500">{{ session('success') }}</span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>