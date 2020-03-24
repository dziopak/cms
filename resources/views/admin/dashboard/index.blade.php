@extends('layouts.admin.containers.full-width')


@push('head')
    <meta name="_token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@1.1.1/dist/gridstack.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/gridstack@1.1.1/dist/gridstack.all.js"></script>
@endpush


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li>{{ __('admin/routes.dashboard') }}</li>
    </ul>
@endsection


@section('module-content')

    {{-- Adding components to dashboard --}}
    @include('admin.partials.dashboard.controls')
    {{-- End --}}


    {{-- Dashboard area --}}
    <div id="dashboard" class="grid-stack">
        @if ($widgets)
            @foreach($widgets as $widget)

                @widget('admin.'.$widget['id'], [
                    'x' => $widget['x'],
                    'y' => $widget['y'],
                    'w' => $widget['w'],
                    'h' => $widget['h'],
                    'auto' => false
                ])  

            @endforeach
        @endif
    </div>
    {{-- End --}}
@endsection

@section('footer')
    @include('admin.partials.dashboard.scripts')
@endsection
