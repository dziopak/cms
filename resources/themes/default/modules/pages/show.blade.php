@extends('Theme::index', ['css' => 'pages'])

@set($title, $page->name)
@set($meta_title, $page->meta_title)
@set($meta_description, $page->meta_description)

@section('module')
    <div class="page page--show">

        <div class="page__excerpt-container row">

            @if (!empty($page->thumbnail))
                <div class="page__thumbnail-col col">
                    <a href="{{ route('front.pages.show', ['id' => $page->id]) }}">
                        <img class="page__thumbnail" src="{{ $page->getThumbnail() }}" alt="{{ $page->getName() }}">
                    </a>
                </div>
            @endif


            <div class="page__content-col col">
                <h3 class="page__title">{{ $page->getName() }}</h3>
                <p class="page__excerpt">{!! $page->getExcerpt() !!}</p>
                <div class="page__details">
                    <strong class="page__details-title">{{ __('Theme::general.category') }}:</strong> {!! !empty($page->category) ? '<a href="'.$page->category->getUrl().'">'.$page->category->name.'</a>' : 'No category' !!}<br/>
                    <strong class="page__details-title">{{ __('Theme::general.tags') }}:</strong> <a href="">same</a>, <a href="">up</a>, <a href="">here</a>
                </div>
            </div>
        </div>

        <div class="page__content">
            {!! $page->getContent() !!}
        </div>
    </div>
@endsection
