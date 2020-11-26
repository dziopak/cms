<div class="post__content-container">
    <h3 class="post__title">{{ $post->getName() }}</h3>
    <p class="post__excerpt">{!! $post->getExcerpt() !!}</p>
    <a href="{{ $post->getUrl() }}" class="post__button btn cta">{{ __('Theme::general.more') }}</a>
</div>
