@extends('Theme::index')

@set($title, $page->name)
@set($meta_title, $page->meta_title)
@set($meta_description, $page->meta_description)
@set($meta_index, $page->index)


@section('module')
    <h2>{{ $page->name }}</h2>
    {!! $page->content !!}
@endsection
