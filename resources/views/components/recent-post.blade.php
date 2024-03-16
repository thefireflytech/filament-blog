@foreach ($posts as $post)
    <a class="text-rum-800 hover:text-primary-700 py-4" href="{{ route('post.show', ['post' => $post->slug]) }}">
        <h3 class="text-base font-medium">
            {{ $post->title }}
        </h3>
    </a>
@endforeach
