@extends('Theme::index', ['css' => 'categories'])

@set($title, $category->name)

@section('module')
    @set($i, 1)

    <div class="category">

        <div class="category__content-container">
            <h3 class="category__title">{{ $category->name }}</h3>
            <p class="category__excerpt">{!! $category->description !!}</p>
        </div>

        @foreach($posts as $key => $entry)
            @php
                $even = $i % 2;
                $i++;
            @endphp


            <div class="entry row">

                {{-- Left column --}}
                <div class="entry__column entry__column--left col {{ $even ? "post__column--even" : "post__column--odd" }}">
                    @if ($even)
                        @include('Theme::modules.categories.partials.thumbnail')
                    @else
                        @include('Theme::modules.categories.partials.content')
                    @endif
                </div>

                {{-- Right column --}}
                <div class="entry__column entry__column--right col {{ $even ? "post__column--even" : "post__column--odd" }}">
                    @if ($even)
                        @include('Theme::modules.categories.partials.content')
                    @else
                        @include('Theme::modules.categories.partials.thumbnail')
                    @endif
                </div>

            </div>
        @endforeach
    </div>
@endsection
