<strong class="post__details-title">{{ __('Theme::general.category') }}:</strong>
@foreach($categories as $category)
    <a href="{{ $category->getUrl() }}">
        {{ $category->name }}
    </a>
@endforeach
