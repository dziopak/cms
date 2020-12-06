@extends('admin.templates.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.settings') }}</a></li>
        <li><a href="{{route('admin.settings.logs.index')}}">{{ __('admin/routes.logs') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    <x-wrapper title="admin/logs.index_title">
        <p>{{ __('admin/logs.index_intro') }}</p>
        <div id="logs-table">
            @include('admin.logs.partials.controls')
            <x-logs :data="$logs" />
        </div>
    </x-wrapper>
@endsection
