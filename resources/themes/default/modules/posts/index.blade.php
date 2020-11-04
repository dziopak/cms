@extends('Theme::index')

@section('module')
    @foreach($posts as $post)
        <div class="post">
            @if (!empty($post->thumbnail))
                <div class="post__thumbnail-col">
                    <a href="{{ route('front.posts.show', ['id' => $post->id]) }}">
                        <img class="post__thumbnail" src="/images/{{ $post->thumbnail->path }}" alt="{{ $post->name }}" width="140">
                    </a>
                </div>
            @endif
            <h3 class="post__title">{{ $post->name }}</h3>
            <p class="post__excerpt">{!! $post->excerpt !!}</p>
            <a href="{{ route('front.posts.show', ['id' => $post->id]) }}" class="btn btn-primary">Read more</a>
        </div>
    @endforeach
    {{ $posts->render() }}
@endsection
