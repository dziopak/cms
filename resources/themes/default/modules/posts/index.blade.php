@extends('Theme::index', ['css' => 'posts'])

@section('module')

    @set($i, 0)
    @foreach($posts as $key => $post)
        @php
            $even = $i % 2;
            $i++;
        @endphp


        <div class="post row">

            {{-- Left column --}}
            <div class="post__column post__column--left col {{ $even ? "post__column--even" : "post__column--odd" }}">
                @if ($even)
                    @include('Theme::modules.posts.partials.thumbnail')
                @else
                    @include('Theme::modules.posts.partials.content')
                @endif
            </div>

            {{-- Right column --}}
            <div class="post__column post__column--right col {{ $even ? "post__column--even" : "post__column--odd" }}">
                @if ($even)
                    @include('Theme::modules.posts.partials.content')
                @else
                    @include('Theme::modules.posts.partials.thumbnail')
                @endif
            </div>

        </div>
    @endforeach
@endsection
