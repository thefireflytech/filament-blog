@foreach($posts as $post)
<a class="py-4 text-rum-800 hover:text-primary-700" href="{{ route('post.show', ['post' => $post->slug]) }}">
    <h3 class="font-medium text-base">
        {{ $post->title }}
    </h3>
</a>
@endforeach