<div class="post__content-container">
    <h3 class="post__title">{{ $post->name }}</h3>
    <p class="post__excerpt">{!! $post->excerpt !!}</p>
    <a href="{{ route('front.posts.show', ['id' => $post->id]) }}" class="btn cta">Read more</a>
</div>
