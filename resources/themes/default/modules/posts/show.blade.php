@extends($theme->data->url.'.index')

@set($title, $post->name)
@set($meta_title, $post->meta_title)
@set($meta_description, $post->meta_description)

@section('module')
        <div class="post post--show">

            <div class="post__excerpt-container">
                @if (!empty($post->thumbnail))
                    <div class="post__thumbnail-col">
                        <a href="{{ route('front.posts.show', ['id' => $post->id]) }}">
                            <img class="post__thumbnail" src="/images/{{ $post->thumbnail->path }}" alt="{{ $post->name }}" width="250">
                        </a>
                    </div>
                @endif

                <h3 class="post__title">{{ $post->name }}</h3>
                <p class="post__excerpt">{!! $post->excerpt !!}</p>
            </div>

            <div class="post__content">
                {!! $post->content !!}
            </div>
        </div>
@endsection
