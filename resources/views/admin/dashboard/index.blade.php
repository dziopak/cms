@extends('layouts.admin.containers.full-width')


@push('head')
    <meta name="_token" content="{{ csrf_token() }}" />
    <script src="{{asset('assets/js/gridstack.all.js')}}"></script>
    <script src="{{asset('assets/js/Chart.js')}}"></script>
    
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/gridstack.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick-theme.css')}}">
@endpush
    
    
@push('scripts-bottom')
    <script src="{{asset('js/admin/dashboard.js')}}" defer></script>
    <script src="{{asset('assets/js/slick.min.js')}}" defer></script>
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
    @include('admin.partials.dashboard.controls')
    </div>
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
