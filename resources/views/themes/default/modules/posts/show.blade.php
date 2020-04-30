@extends($theme->data->url.'.index')

@section('module')
        <div class="post row">

            @if (!empty($post->thumbnail))
                <div class="col post__thumbnail-col">
                    <img class="post__thumbnail" src="/images/{{ $post->thumbnail->path }}" alt="{{ $post->name }}">
                </div>
            @endif

            <div class="col">
                <h3 class="post__title">{{ $post->name }}</h3>
                <p class="post__excerpt">{!! $post->content !!}</p>
            </div>

        </div>
@endsection