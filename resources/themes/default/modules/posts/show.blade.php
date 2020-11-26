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
                                <img class="post__thumbnail" src="{{ $post->getThumbnail() }}" alt="{{ $post->getName() }}">
                            </a>
                        </div>
                    @endif
                </div>

                <div class="col">
                    <h3 class="post__title">{{ $post->getName() }}</h3>
                    <p class="post__excerpt">{!! $post->getExcerpt() !!}</p>

                    <div class="post__details">

                        {{-- Categories --}}
                        @if (!empty($post->categories))
                            @include('Theme::partials.categories', ['categories' => $post->categories])<br/>
                        @endif

                        {{-- Tags --}}
                        <strong class="post__details-title">{{ __('Theme::general.tags') }}:</strong> <a href="">same</a>, <a href="">up</a>, <a href="">here</a>
                    </div>
                </div>
            </div>

            <div class="post__content">
                {!! $post->getContent() !!}
            </div>
        </div>
@endsection
