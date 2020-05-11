@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{ route('admin.plugins.index') }}">{{ __('admin/routes.modules') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/plugins.active'])
        @include('admin.partials.table', ['fields' => $modules['active'], 'mass_edit_by' => 'name'])
    @endwrapper

    @wrapper('admin.partials.wrapper', ['title' => 'admin/plugins.inactive'])
        @include('admin.partials.table', ['fields' => $modules['inactive'], 'mass_edit_by' => 'name'])
    @endwrapper
@endsection
