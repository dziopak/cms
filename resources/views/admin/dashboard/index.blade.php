@extends('admin.templates.full-width')


@push('head')
    <script src="{{asset('assets/js/gridstack.all.js')}}"></script>
    <script src="{{asset('assets/js/Chart.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/gridstack.min.css')}}">
@endpush


@push('scripts-bottom')
    <script src="{{asset('js/admin/dashboard.js')}}" defer></script>
    <script src="{{asset('assets/js/glide.min.js')}}" defer></script>
@endpush


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li>{{ __('admin/routes.dashboard') }}</li>
    </ul>
@endsection


@section('module-content')

    {{-- Adding components to dashboard --}}
    <div class="row">
    @include('admin.dashboard.partials.controls')
    </div>
    {{-- End --}}


    {{-- Dashboard area --}}
    <div id="dashboard" class="grid-stack">
        @if ($widgets)
            @foreach($widgets as $widget)
                @set($component, $prefix.$widget['id'])
                <x-dynamic-component :component="$component" :widget="$widget" :auto="true" />
            @endforeach
        @endif
    </div>
    {{-- End --}}
@endsection

@section('footer')
    @include('admin.dashboard.partials.scripts')
@endsection
