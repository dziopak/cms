<div class="entry__thumbnail-col">
    @if (!empty($entry->thumbnail))
        <a href="{{ $entry->getUrl() }}">
            <img class="entry__thumbnail" src="/images/{{ $entry->thumbnail->path }}" alt="{{ $entry->name }}">
        </a>
    @endif
</div>
