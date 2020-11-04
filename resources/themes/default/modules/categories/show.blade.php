@extends($theme->data->url.'.index')
@set($title, $category->name)

@section('module')
    <div class="module-page">

        {{-- Category details --}}
        <div class="category-intro mb-5">
            <h2>{{ $category->name }}</h2>
            {!! $category->description !!}
        </div>

        {{-- Category content --}}
        <div class="category-content">
            <h3>Newest content in this category</h3>
            @foreach($entries as $entry)
                <div class="post">
                    @if (!empty($entry->thumbnail))
                        <div class="post__thumbnail-col">
                            <a href="{{ route('front.'.$type.'.show', ['id' => $entry->slug]) }}">
                                <img class="post__thumbnail" src="/images/{{ $entry->thumbnail->path }}" alt="{{ $entry->name }}" width="140">
                            </a>
                        </div>
                    @endif
                    <h3 class="post__title">{{ $entry->name }}</h3>
                    <p class="post__excerpt">{!! $entry->excerpt !!}</p>
                    <a href="{{ route('front.'.$type.'.show', ['id' => $entry->slug]) }}" class="btn btn-primary">Read more</a>
                </div>
            @endforeach
        </div>

        {{ $entries->render() }}
    </div>
@endsection
