<div class="post__content-container">
    <h3 class="post__title">{{ $post->name }}</h3>
    <p class="post__excerpt">{!! $post->excerpt !!}</p>
    <a href="{{ $post->getUrl() }}" class="btn cta">Read more</a>
</div>
