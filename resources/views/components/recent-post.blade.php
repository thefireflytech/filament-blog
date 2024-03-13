@foreach($posts as $post)
    <a class="py-5 hover:text-blue-600" href="{{ route('post.show', ['post' => $post->slug]) }}">
        <h3 class="font-medium text-base">
            {{ $post->title }}
        </h3>
    </a>
@endforeach