<div class="post__thumbnail-col">
    @if (!empty($post->thumbnail))
        <a href="{{ route('front.posts.show', ['id' => $post->id]) }}">
            <img class="post__thumbnail" src="{{ $post->getThumbnail() }}" alt="{{ $post->name }}">
        </a>
    @endif
</div>
