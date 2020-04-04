@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{ route('admin.modules.index') }}">{{ __('admin/routes.modules') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'admin/modules.active'])
        @include('admin.partials.table', ['fields' => $modules['active'], 'mass_edit_by' => 'name'])
    @endwrapper

    @wrapper('admin.partials.widget', ['title' => 'admin/modules.inactive'])
        @include('admin.partials.table', ['fields' => $modules['inactive'], 'mass_edit_by' => 'name'])
    @endwrapper
@endsection
