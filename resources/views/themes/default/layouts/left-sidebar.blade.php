@extends($theme->data->url.'.index')


@section('main')
    <div class="widget-area row"></div>
    <div class="row">
        <div class="widget-area col-3"></div>
        <div class="col-9">
            @yield('module')
        </div>
    </div>
    <div class="widget-area row"></div>
@endsection
