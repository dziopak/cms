@extends('Theme::index', ['css' => 'posts'])

@set($title, $post->name)
@set($meta_title, $post->meta_title)
@set($meta_description, $post->meta_description)

@section('module')
        <div class="post post--show">

            <div class="post__excerpt-container row">
                <div class="col post__thumbnail-container">
                    @if (!empty($post->thumbnail))
                        <div class="post__thumbnail-col">
                            <a href="{{ route('front.posts.show', ['id' => $post->id]) }}">
                                <img class="post__thumbnail" src="/images/{{ $post->thumbnail->path }}" alt="{{ $post->name }}">
                            </a>
                        </div>
                    @endif
                </div>

                <div class="col">
                    <h3 class="post__title">{{ $post->name }}</h3>
                    <p class="post__excerpt">{!! $post->excerpt !!}</p>

                    <div class="post__details">
                        <strong class="post__details-title">{{ __('Theme::general.category') }}:</strong> {!! !empty($post->category) ? '<a href="'.$post->category->getUrl().'">'.$post->category->name.'</a>' : 'No category' !!}<br/>
                        <strong class="post__details-title">{{ __('Theme::general.tags') }}:</strong> <a href="">same</a>, <a href="">up</a>, <a href="">here</a>
                    </div>
                </div>
            </div>

            <div class="post__content">
                {!! $post->content !!}
            </div>
        </div>
@endsection
