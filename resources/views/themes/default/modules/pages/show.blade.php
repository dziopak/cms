@extends($theme->data->url.'.index')

@section('module')
    <div class="module-page">
        <h3>{{ $page->name }}</h3>
        {!! $page->content !!}
    </div>
@endsection
