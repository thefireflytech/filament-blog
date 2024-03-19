<x-blog-layout>
    <section class="py-10">
        <header class="container mx-auto px-6">
            <h3 class="inherits-color text-balance leading-tighter relative z-10 text-3xl font-semibold tracking-tight">
                Latest News / Blogs
            </h3>
        </header>
    </section>
    <section class="pb-16 pt-8">
        <div class="container mx-auto">
            <div class="grid gap-x-14 gap-y-14 sm:grid-cols-3">
                @foreach ($posts as $post)
                    <x-blog-card :post="$post"/>
                @endforeach
            </div>
            <div class="mt-20">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

</x-blog-layout>
