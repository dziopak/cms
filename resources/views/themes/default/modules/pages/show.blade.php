@extends($theme->data->url.'.index')

@set($title, $page->name)
@set($meta_title, $page->meta_title)
@set($meta_description, $page->meta_description)
@set($meta_index, $page->index)


@section('module')
    <div class="module-page">
        <h3>{{ $page->name }}</h3>
        {!! $page->content !!}
    </div>
@endsection
