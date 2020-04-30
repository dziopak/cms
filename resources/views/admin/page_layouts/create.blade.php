@extends('admin.layouts.columns-8-4')


@push('head')
    <meta name="_token" content="{{ csrf_token() }}" />
    <script src="{{asset('assets/js/gridstack.all.js')}}"></script>
    <script src="{{asset('assets/js/Chart.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/layouts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/gridstack.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick-theme.css')}}">
@endpush


@push('scripts-bottom')
    <script src="{{asset('js/admin/layouts.js')}}" defer></script>
    <script src="{{asset('assets/js/slick.min.js')}}" defer></script>
    @include('admin.page_layouts.partials.scripts')
@endpush


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{ route('admin.pages.index') }}">{{ __('admin/routes.pages') }}</a></li>
        <li><a href="{{ route('admin.pages.layouts.index') }}">{{ __('admin/routes.layouts') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')
    <div id="fade"></div>
    @include('admin.page_layouts.partials.controls')
    {!! Form::open(['method' => 'POST', 'action' => ['admin\LayoutsController@store'], 'class' => 'w-100', 'id' => 'LayoutCreateForm']) !!}
@endsection


@section('content-left')
    @include('admin.partials.validation')

    <div id="layout" class="grid-stack">
        @include('admin.blocks.module', ['config' => [
            'x' => 0,
            'y' => 0,
            'w' => 12,
            'h' => 1,
            'block_id' => 0
        ]])
    </div>
@endsection


@section('content-right')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/layouts.index_title'])
        @include('partials.form-fields', ['fields' => $form['basic_data']])
        {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mt-4', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    @endwrapper
@endsection