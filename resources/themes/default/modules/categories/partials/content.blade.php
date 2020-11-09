<div class="entry__content-container">
    <h3 class="entry__title">{{ $entry->name }}</h3>
    <p class="entry__excerpt">{!! $entry->excerpt !!}</p>
    <a href="{{ $entry->getUrl() }}" class="btn cta">Read more</a>
</div>
